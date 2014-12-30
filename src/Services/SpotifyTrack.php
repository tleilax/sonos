<?php

namespace duncan3dc\Sonos\Services;

/**
 * Representation of a Spotify track.
 */
class SpotifyTrack extends AbstractSpotify
{
    /**
     * @var string $type The type of Spotify resource.
     */
    protected $type = "track";

    /**
     * Get the URI for this track.
     *
     * @return string
     */
    public function getUri()
    {
        return "x-sonos-spotify:" . parent::getUri();
    }
}
