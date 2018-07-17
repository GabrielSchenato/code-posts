<?php

namespace CodePress\CodePosts\Controllers;

use CodePress\CodePosts\Repository\CommentRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

/**
 * Description of AdminCommentsController
 *
 * @author gabriel
 */
class AdminCommentsController extends Controller
{

    private $response;
    private $repository;
    
    public function __construct(ResponseFactory $response, CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->response = $response;
    }
    
    public function index()
    {
        $comments = $this->repository->all();
        return $this->response->view('codecomment::index', compact('comments'));
    }
    
    public function show(int $id)
    {
        $comment = $this->repository->find($id);
        return $this->response->view('codecomment::show', compact('comment'));
    }
    
    public function create()
    {
        return $this->response->view('codecomment::create');
    }
    
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->back();
    }
    
    public function edit(int $id)
    {
        $comment = $this->repository->find($id);
        return $this->response->view('codecomment::edit', compact('comment'));
    }
    
    public function update(int $id, Request $request)
    {
        $this->repository->update($request->all(), $id);
        
        return redirect()->route('admin.comments.index');
    }
    
    public function destroy(int $id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('admin.comments.index');
    }
    
    public function deleted()
    {
        $comments = $this->repository->deleted();
        return $this->response->view('codecomment::deleted', compact('comments'));
    }
    
    public function restore(int $id)
    {
        $this->repository->restore($id);
        return redirect()->route('admin.comments.index');
    }
}
