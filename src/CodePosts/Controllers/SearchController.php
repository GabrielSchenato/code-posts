<?php

namespace CodePress\CodePosts\Controllers;

use CodePress\CodePosts\Repository\PostRepositoryInterface;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Description of SearchController
 *
 * @author gabriel
 */
class SearchController extends Controller
{

    private $response;
    private $repository;
    private $tagRepository;
    private $categoryRepository;

    public function __construct(ResponseFactory $response, PostRepositoryInterface $repository, TagRepositoryInterface $tagRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $repository;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
        $this->response = $response;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getCategoriesAndCount('posts');
        $tags = $this->tagRepository->getTagsAndCount('posts');
        $posts = $this->repository->all();
        return $this->response->view('codefront::posts', compact('categories', 'posts', 'tags'));
    }

    public function searchByCategory(string $slug)
    {
        $categories = $this->categoryRepository->getCategoriesAndCount('posts');
        $tags = $this->tagRepository->getTagsAndCount('posts');
        $category = $this->categoryRepository->findBy('slug', $slug)->first();

        $posts = $category->posts;
        return $this->response->view('codefront::posts', compact('categories', 'posts', 'tags'));
    }
    
    public function searchByTag(string $slug)
    {
        $categories = $this->categoryRepository->getCategoriesAndCount('posts');
        $tags = $this->tagRepository->getTagsAndCount('posts');
        $tag = $this->tagRepository->findBy('slug', $slug)->first();

        $posts = $tag->posts;
        return $this->response->view('codefront::posts', compact('categories', 'posts', 'tags'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        $categories = $this->categoryRepository->getCategoriesAndCount('posts');
        $tags = $this->tagRepository->getTagsAndCount('posts');
        $posts = $this->repository->findWhere('title', "%{$q}%");
        
        return $this->response->view('codefront::posts', compact('categories', 'posts', 'tags'));
    }
    
    public function searchPostBySlug(string $slug)
    {
        $categories = $this->categoryRepository->getCategoriesAndCount('posts');
        $tags = $this->tagRepository->getTagsAndCount('posts');
        $post = $this->repository->findBy('slug', $slug)->first();
        
        return $this->response->view('codefront::post', compact('categories', 'post', 'tags'));
    }
}
