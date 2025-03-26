<?php

return [
    'formats' => [
        'ディベート甲子園(高校の部)(NADA)' => [
            1 => ['speaker' => 'affirmative', 'name' => '立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            2 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            3 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            4 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            5 => ['speaker' => 'negative', 'name' => '立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            6 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            7 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            8 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            9 => ['speaker' => 'negative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            10 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            11 => ['speaker' => 'affirmative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            12 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            13 => ['speaker' => 'negative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            14 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            15 => ['speaker' => 'affirmative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
        ],
        '全国高校生英語ディベート大会(HEnDA)' => [
            1 => ['speaker' => 'affirmative', 'name' => '立論', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            2 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            3 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 2 * 60, 'is_prep_time' => false, 'is_questions' => true],
            4 => ['speaker' => 'negative', 'name' => '立論', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            5 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 1 * 60, 'is_prep_time' => true, 'is_questions' => false],
            6 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 2 * 60, 'is_prep_time' => false, 'is_questions' => true],
            7 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            8 => ['speaker' => 'negative', 'name' => 'アタック', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
            9 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 2 * 60, 'is_prep_time' => false, 'is_questions' => true],
            10 => ['speaker' => 'affirmative', 'name' => 'アタック', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
            11 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 2 * 60, 'is_prep_time' => false, 'is_questions' => true],
            12 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            13 => ['speaker' => 'affirmative', 'name' => 'ディフェンス', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
            14 => ['speaker' => 'negative', 'name' => 'ディフェンス', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
            15 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            16 => ['speaker' => 'affirmative', 'name' => '総括', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
            17 => ['speaker' => 'negative', 'name' => '総括', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => false],
        ],
        '全日本大学ディベート選手権大会(CoDA)' => [
            1 => ['speaker' => 'affirmative', 'name' => '立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            2 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            3 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            4 => ['speaker' => 'negative', 'name' => '立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            5 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            6 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            7 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            8 => ['speaker' => 'negative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            9 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            10 => ['speaker' => 'affirmative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            11 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 3 * 60, 'is_prep_time' => true, 'is_questions' => false],
            12 => ['speaker' => 'negative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            13 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 3 * 60, 'is_prep_time' => true, 'is_questions' => false],
            14 => ['speaker' => 'affirmative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
        ],
        'JDAディベート大会(JDA)' => [
            1 => ['speaker' => 'affirmative', 'name' => '第一立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            2 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            3 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            4 => ['speaker' => 'negative', 'name' => '第一立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            5 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            6 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            7 => ['speaker' => 'affirmative', 'name' => '第二立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            8 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            9 => ['speaker' => 'negative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            10 => ['speaker' => 'negative', 'name' => '第二立論', 'duration' => 6 * 60, 'is_prep_time' => false, 'is_questions' => false],
            11 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            12 => ['speaker' => 'affirmative', 'name' => '質疑', 'duration' => 3 * 60, 'is_prep_time' => false, 'is_questions' => true],
            13 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            14 => ['speaker' => 'negative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            15 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            16 => ['speaker' => 'affirmative', 'name' => '第一反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            17 => ['speaker' => 'negative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            18 => ['speaker' => 'negative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
            19 => ['speaker' => 'affirmative', 'name' => '準備時間', 'duration' => 2 * 60, 'is_prep_time' => true, 'is_questions' => false],
            20 => ['speaker' => 'affirmative', 'name' => '第二反駁', 'duration' => 4 * 60, 'is_prep_time' => false, 'is_questions' => false],
        ],
    ],
];
