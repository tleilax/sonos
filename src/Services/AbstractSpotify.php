<?php

namespace duncan3dc\Sonos\Services;

use duncan3dc\DomParser\XmlWriter;
use duncan3dc\Sonos\Tracks\UriInterface;

/**
 * Representation of a Spotify resource (track/album/etc).
 */
abstract class AbstractSpotify implements UriInterface
{
    const HASH = "0004006c";

    /**
     * @var int $id The ID of Spotify resource.
     */
    protected $id = "";

    /**
     * @var string $type The type of Spotify resource.
     */
    protected $type = "";

    /**
     * @var string $uri The uri of the resource.
     */
    protected $uri = "";

    /**
     * Create a Spotify resource object.
     *
     * @param int $id The ID of Spotify resource
     * @param string $type The type of Spotify resource.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->uri = "spotify:{$this->type}:{$this->id}";
    }


    /**
     * Get the URI for this track.
     *
     * @return string
     */
    public function getUri()
    {
        return self::HASH . urlencode($this->uri);
    }


    /**
     * Get the metadata xml for this track.
     *
     * @return string
     */
    public function getMetaData()
    {
        $xml = XmlWriter::createXml([
            "DIDL-Lite" =>  [
                "_attributes"   =>  [
                    "xmlns:dc"      =>  "http://purl.org/dc/elements/1.1/",
                    "xmlns:upnp"    =>  "urn:schemas-upnp-org:metadata-1-0/upnp/",
                    "xmlns:r"       =>  "urn:schemas-rinconnetworks-com:metadata-1-0/",
                    "xmlns"         =>  "urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/",
                ],
                "item"  =>  [
                    "_attributes"   =>  [
                        "id"            =>  self::HASH . urlencode($this->uri),
                        "parentID"      =>  "-1",
                        "restricted"    =>  "true",
                    ],
                    "dc:title"      =>  "",
                    "upnp:class"    =>  "object.item.audioItem.musicTrack",
                    "desc"          =>  [
                        "_attributes"   =>  [
                            "id"        =>  "cdudn",
                            "nameSpace" =>  "urn:schemas-rinconnetworks-com:metadata-1-0/",
                        ],
                        "_value"        =>  "SA_RINCON2311_X_#Svc2311-0-Token",
                    ],
                ],
            ]
        ]);

        # Get rid of the xml header as only the DIDL-Lite element is required
        $meta = explode("\n", $xml)[1];

        return $meta;
    }
}
