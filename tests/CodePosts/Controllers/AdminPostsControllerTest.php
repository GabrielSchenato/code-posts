<?php

namespace CodePress\CodePosts\Tests\Controllers;

use CodePress\CodePosts\Repository\PostRepositoryEloquent;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use CodePress\CodePosts\Tests\AbstractTestCase;
use CodePress\CodePosts\Controllers\AdminPostsController;
use CodePress\CodePosts\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;

/**
 * Description of AdminPostsControllerTest
 *
 * @author gabriel
 */
class AdminPostsControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $tagRepository = m::mock(TagRepositoryInterface::class);
        $categoryRepository = m::mock(CategoryRepositoryInterface::class);
        $controller = new AdminPostsController($responseFactory, $repository, $tagRepository, $categoryRepository);

        $this->assertInstanceOf(Controller::class, $controller);
    }
    
    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $tagRepository = m::mock(TagRepositoryInterface::class);
        $categoryRepository = m::mock(CategoryRepositoryInterface::class);
        $controller = new AdminPostsController($responseFactory, $repository, $tagRepository, $categoryRepository);
        $html = m::mock();
        
        $postsResult = ['post1', 'post2'];
        $repository->shouldReceive('all')->andReturn($postsResult);
        
        $responseFactory->shouldReceive('view')
                ->with('codepost::index', ['posts' => $postsResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
    
    public function test_controller_should_run_show_method_and_return_correct_argument()
    {
        $repository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $tagRepository = m::mock(TagRepositoryInterface::class);
        $categoryRepository = m::mock(CategoryRepositoryInterface::class);
        $controller = new AdminPostsController($responseFactory, $repository, $tagRepository, $categoryRepository);
        $html = m::mock();
        
        $repositoryResult = ['post1'];
        
        $repository->shouldReceive('find')->with(1)->andReturn($repositoryResult);
        
        $responseFactory->shouldReceive('view')
                ->with('codepost::show', ['post' => $repositoryResult])
                ->andReturn($html);

        $this->assertEquals($controller->show(1), $html);
    }

}
