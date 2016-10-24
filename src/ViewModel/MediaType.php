<?php

namespace eLife\Patterns\ViewModel;

use Assert\Assertion;
use eLife\Patterns\ArrayFromProperties;
use eLife\Patterns\CastsToArray;
use eLife\Patterns\ReadOnlyArrayAccess;

final class MediaType implements CastsToArray
{
    use ArrayFromProperties;
    use ReadOnlyArrayAccess;

    private $forMachine;
    private $forHuman;

    public function __construct(string $mediaType)
    {
        Assertion::regex($mediaType,
            '/^([a-zA-Z0-9!#$%^&\*_\-\+{}\|\'.`~]+\/[a-zA-Z0-9!#$%^&\*_\-\+{}\|\'.`~]+)(; *[a-zA-Z0-9!#$%^&\*_\-\+{}\|\'.`~]+=(([a-zA-Z0-9\.\-]+)|(".+")))*$/');

        $this->forMachine = $mediaType;
        $this->forHuman = $this->guessHumanType();
    }

    private function guessHumanType()
    {
        switch ($this->forMachine) {
            case 'image/pjpeg':
                return 'JPEG';
            case 'audio/mp4':
            case 'video/mp4':
                return 'MPEG-4';
            case 'application/ogg':
            case 'audio/ogg':
            case 'video/ogg':
                return 'Ogg';
            case 'audio/webm':
            case 'video/webm':
                return 'WebM';
            case 'image/webp':
                return 'WebP';
        }

        $parts = explode('/', $this->forMachine);

        return strtoupper($parts[1]);
    }
}