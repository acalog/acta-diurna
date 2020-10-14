<?php

namespace App\Exceptions;


class RejectTags
{
    public static function check($tag)
    {
        $common = [
            'so',
            'up',
            'way',
            'becomes',
            'you',
            'like',
            'it',
            'the',
            'during',
            'pilot',
            'his',
            'her',
            'control',
            'take',
            'their',
            'lets',
            'on',
            'and',
            'gets',
            'with',
            'to',
            'the',
            'from',
            'a',
            'out',
            '',
            ' ',
            'w',
            'be',
            'i',
            'my',
            'likes',
            'at',
            'in',
            'your',
            'for',
            'the',
            'night',
            'by',
            'just',
            'want',
            'have',
            'me',
            'drives',
            'of',
            'tonights',
            'tonight',
            'front',
            'incident',
            'skateboarding',
            'after',
            'sons',
            '&',
            'phdcb',
            'step',
            'son',
            'attempts',
            'fjf',
            'man',
            'boyfriend',
            'get',
            'meet',
            'meets',
            'own',
            'owns',
            'use',
            'uses',
            'is',
            'visit',
            'visits',
            's',
            'e',
            'before',
            'that',
            'takes',
            'care',
            'first',
            'gives',
            'stepkid',
            'phccefcd',
            'xwy',
            'hotelphedeee',
            'nightyjxvd',
            'phaab',
            'sessionphfedd',
            'phcdcfaa',
            'phbdcadef',
            'montage',
            'while',
            'wants',
            'what',
            'twice',
            'times',
            'tiktok',
            'taken',
            'sunday',
            'stuff',
            'shows',
            'show',
            'room',
            'makes',
            'mall',
            'give',
            'got',
            'has',
            'does',
            'dont',
            'aaane',
            'can',
            'rid',
            'some',
            'nf',
            'off',
            'p'
        ];
        return !in_array($tag, $common);
    }
}
