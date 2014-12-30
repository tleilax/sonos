<?php

namespace duncan3dc\Sonos\Services;

/**
 * Representation of a Spotify album.
 */
class SpotifyAlbum extends AbstractSpotify
{
    /**
     * @var string $type The type of Spotify resource.
     */
    protected $type = "album";

    /**
     * Get the URI for this track.
     *
     * @return string
     */
    public function getUri()
    {
        return "x-rincon-cpcontainer:" . parent::getUri();
    }
}
