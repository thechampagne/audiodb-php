<?php
/**
 * TheAudioDB API client
 *
 * @author  XXIV
 * @license Apache 2.0
 */
namespace XXIV\AudioDB;

class AudioDBException extends \Exception {}

function _getRequest($endpoint) {
  $response = @file_get_contents("https://theaudiodb.com/api/v1/json/2/$endpoint");
  if ($response === false) {
    throw new \Exception($http_response_header[0]);
  }
  return $response;
}

// Return Artist details from artist name
function searchArtist($s) {
  try {
    $response = _getRequest("search.php?s=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["artists"] || count($data["artists"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["artists"];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return Discography for an Artist with Album names and year only
function discography($s) {
  try {
    $response = _getRequest("discography.php?s=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["album"] || count($data["album"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["album"];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return individual Artist details using known Artist ID
function searchArtistById($i) {
  try {
    $response = _getRequest("artist.php?i=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["artists"] || count($data["artists"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["artists"][0];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return individual Album info using known Album ID
function searchAlbumById($i) {
  try {
    $response = _getRequest("album.php?m=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["album"] || count($data["album"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["album"][0];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return All Albums for an Artist using known Artist ID
function searchAlbumsByArtistId($i) {
  try {
    $response = _getRequest("album.php?i=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["album"] || count($data["album"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["album"];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return All Tracks for Album from known Album ID
function searchTracksByAlbumId($i) {
  try {
    $response = _getRequest("track.php?m=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["track"] || count($data["track"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["track"];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return individual track info using a known Track ID
function searchTrackById($i) {
  try {
    $response = _getRequest("track.php?h=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["track"] || count($data["track"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["track"][0];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}

// Return all the Music videos for a known Artist ID
function searchMusicVideosByArtistId($i) {
  try {
    $response = _getRequest("mvid.php?i=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["mvids"] || count($data["mvids"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["mvids"];
  } catch(\Exception $err) {
    throw new AudioDBException($err->getMessage());
  }
}
?>