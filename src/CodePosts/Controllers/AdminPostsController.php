<?php

namespace CodePress\CodePosts\Controllers;

use CodePress\CodePosts\Repository\PostRepositoryInterface;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Description of AdminPostsController
 *
 * @author gabriel
 */
class AdminPostsController extends Controller
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
        $posts = $this->repository->all();
        return $this->response->view('codepost::index', compact('posts'));
    }

    public function show(int $id)
    {
        $post = $this->repository->find($id);
        return $this->response->view('codepost::show', compact('post'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->all()->pluck('name', 'id');
        $tags = $this->tagRepository->all()->pluck('name', 'id');
        
        return $this->response->view('codepost::create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user'] = Auth::user();
        $this->repository->create($data);

        return redirect()->route('admin.posts.index');
    }

    public function edit(int $id)
    {
        $post = $this->repository->find($id);
        $categories = $this->categoryRepository->all()->pluck('name', 'id');
        $tags = $this->tagRepository->all()->pluck('name', 'id');
        
        return $this->response->view('codepost::edit', compact('post', 'categories', 'tags'));
    }

    public function update(int $id, Request $request)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(int $id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('admin.posts.index');
    }

    public function deleted()
    {
        $posts = $this->repository->deleted();
        return $this->response->view('codepost::deleted', compact('posts'));
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
        return redirect()->route('admin.posts.index');
    }

    public function updateState(Request $request, int $id)
    {
        $this->repository->updateState($id, $request->get('state'));
        return redirect()->route('admin.posts.edit', ['id' => $id]);
    }

}
