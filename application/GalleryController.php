<?php

namespace Application;

class GalleryController
{
	public function listAction()
	{
		$data = array(
			'galleries' => $this->getGalleriesData(),
			'is_logged_in' => $this->getUserIsLoggedIn()
		);
		return $data;
	}

	public function viewAction()
	{
		$gallery = $this->getGalleryViaRequest();
		$photos = $this->getPhotosInGallery($gallery);

		$userStorage = new UserStorage;
		$isLoggedIn = $userStorage->isLoggedIn();

		return array(
			'gallery' => $gallery,
			'photos' => $photos,
			'is_logged_in' => $this->getUserIsLoggedIn()
		);
	}

	public function editAction()
	{
		if (!$this->getUserIsLoggedIn()) {
			throw new \Exception("Invalid permissions");
		}

		$gallery = $this->getGalleryViaRequest();

		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			return array('gallery' => $gallery);
		}

		//POST REQUEST
		//edit the gallery json file
		$galleries = $this->getGalleriesData();

		$finalGalleries = array();


		json_encode($galleries);

	}

	private function getUserIsLoggedIn()
	{
		$userStorage = new UserStorage;
		return $userStorage->isLoggedIn();
	}

	private function getPhotosInGallery($gallery)
	{
		$photos = array();
		foreach ($this->getPhotosData() as $photo)
		{
			if ($photo->gallery_id == $gallery->id)
			{
				$photos[] = $photo;
			}
		}
		return $photos;
	}

	private function getPhotosData()
	{
		return Data::getJsonFromFile('photos.json');
	}

	private function getGalleriesData()
	{
		return Data::getJsonFromFile('galleries.json');
	}


	private function getGalleryViaRequest()
	{
		parse_str($_SERVER['QUERY_STRING'], $params);
		if (!isset($params['id'])) {
			throw new \Exception("Id parameter missing from request");
		}

		$idParam = (int) $params['id'];

		if (!is_int($idParam)) {
			throw new \Exception('id paramter must be integer');
		}


		$gallery = $this->getGalleryById($params['id']);
		if (!$gallery) {
			throw new \Exception("Gallery with id: $idParam does not exist");
		}

		return $gallery;
	}

	private function getGalleryById($id)
	{

		foreach ($this->getGalleriesData() as $gallery) 
		{
			if ($gallery->id === $id) {
				return $gallery;
			}
		}

		return null;
	}
}