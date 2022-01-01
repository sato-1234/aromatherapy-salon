<?php
declare(strict_types=1);
namespace App\Services\Admin;

use App\Models\Photo;

abstract class PhotoService{

	protected Photo $photoRepository;

	public function __construct(Photo $photoRepository)
	{
		$this->photoRepository = $photoRepository;
	}

	/**
	 * 単体id存在確認
	 * @return bool
	 */
	public function checkId(int $id): bool
	{
		return $this->photoRepository->where('id', $id)->exists();
	}

	/**
	 * 複数id存在確認
	 * @return bool
	 */
	public function checkIds(array $ids): bool
	{
		$ids = array_map('intval', $ids);
		return $this->photoRepository->whereIn('id', $ids)->exists();
	}
}
