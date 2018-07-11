<?php

namespace CodePress\CodePosts\Controllers;

use CodePress\CodePosts\Repository\PostRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

/**
 * Description of AdminPostsController
 *
 * @author gabriel
 */
class AdminPostsController extends Controller
{

    private $response;
    private $repository;
    
    public function __construct(ResponseFactory $response, PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        return $this->response->view('codepost::create');
    }
    
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('admin.posts.index');
    }
    
    public function edit(int $id)
    {
        $post = $this->repository->find($id);
        return $this->response->view('codepost::edit', compact('post'));
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
}
