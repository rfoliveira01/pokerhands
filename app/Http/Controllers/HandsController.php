<?php

namespace App\Http\Controllers;

use App\Hand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HandsController extends Controller
{

    function index()
    {
        return view('upload');
    }

    function upload()
    {

        $fp = fopen($_FILES['file']['tmp_name'], 'rb');
        while (($line = fgets($fp)) !== false) {
            $round_id = Str::uuid()->toString();
            $cards = explode(" ", $line);
            Hand::create([
                'round' => $round_id,
                'player' => 1,
                'card_1' => $cards[0],
                'card_2' => $cards[1],
                'card_3' => $cards[2],
                'card_4' => $cards[3],
                'card_5' => $cards[4],
            ]);
            Hand::create([
                'round' => $round_id,
                'player' => 2,
                'card_1' => $cards[4],
                'card_2' => $cards[6],
                'card_3' => $cards[7],
                'card_4' => $cards[8],
                'card_5' => $cards[9],
            ]);
        }
        return redirect('hands/');

    }

    function listHands()
    {
        $hands = DB::table('hands')
            ->select('*')
            ->orderByRaw('round, player')
            ->get();
        $list = [];
        $total = [1 => 0, 2 => 0];
        foreach ($hands as $hand) {
            $hand_array = [$hand->card_1, $hand->card_2, $hand->card_3, $hand->card_4, $hand->card_5];
            $list[$hand->round][$hand->player]['hand'] = implode(" ", $hand_array);
            $list[$hand->round][$hand->player]['score-weight'] = $this->analyzeHand($hand_array);
            $list[$hand->round][$hand->player]['score'] = Hand::SCORE_WEIGHTS[$this->analyzeHand($hand_array)];
            if ($hand->player == 2) {
                if ($list[$hand->round][1]['score-weight'] > $list[$hand->round][2]['score-weight']) {
                    $total[1]++;
                    $list[$hand->round]['winner'] = 'Player 1';
                } elseif ($list[$hand->round][2]['score-weight'] > $list[$hand->round][1]['score-weight']) {
                    $total[2]++;
                    $list[$hand->round]['winner'] = 'Player 2';
                } else {
                    $list[$hand->round]['winner'] = 'Draw';
                }
            }
        }
        return view('list', ["list"=>$list, "total"=> $total]);
    }

    private function analyzeHand(array $hand)
    {
        $faceCount = [];
        $straight = 0;
        $flush = 0;

        foreach ($hand as $card) {

            $face = array_search($card[0], Hand::FACES);

            $straight |= (1 << $face);

            isset($faceCount[$face]) ? $faceCount[$face]++ : $faceCount[$face] = 1;

            $flush |= (1 << array_search($card[1], Hand::SUITS));
        }

        // shift the bit pattern to the right as far as possible
        while ($straight % 2 == 0)
            $straight >>= 1;

        // straight is 00011111; A-2-3-4-5 is 1111000000001
        $hasStraight = $straight == 0b11111 || $straight == 0b1111000000001;

        // unsets right-most 1-bit, which may be the only one set
        $hasFlush = ($flush & ($flush - 1)) == 0;

        if ($hasStraight && $hasFlush)
            return 9;

        $total = 0;
        foreach ($faceCount as $count) {
            if ($count == 4)
                return 8;
            if ($count == 3)
                $total += 3;
            else if ($count == 2)
                $total += 2;
        }

        if ($total == 5)
            return 7;

        if ($hasFlush)
            return 6;

        if ($hasStraight)
            return 5;

        if ($total == 3)
            return 4;

        if ($total == 4)
            return 3;

        if ($total == 2)
            return 2;

        return 1;
    }
}
