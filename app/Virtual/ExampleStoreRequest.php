<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example storring request",
 *     description="Some simple request createa as example",
 * )
 */
class ExampleStoreRequest
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of key for storring",
     *     example="random",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     title="Author",
     *     description="author for storring",
     *     example="awesome",
     * )
     *
     * @var string
     */
    public $author;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="description for storring",
     *     example="awesome",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Category",
     *     description="Category for storring",
     *     example="awesome",
     * )
     *
     * @var string
     */
    public $category;

    /**
     * @OA\Property(
     *     title="Cover",
     *     description="Cover for storring",
     *     example="awesome",
     * )
     *
     * @var string
     */
    public $cover;
}
