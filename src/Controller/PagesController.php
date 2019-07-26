<?php

namespace App\Controller;

use App\Entity\PageBlog;
use App\Repository\PageBlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(PageBlogRepository $repository)
    {
        $blogs = $repository->findBy([],['datePub'=>'DESC'],3);
        return $this->render('pages/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function show(PageBlogRepository $blogsRepository)
    {
        $blogs = $blogsRepository->findBy([],['datePub'=>'DESC']);
        return $this->render('pages/show.html.twig', [
            'blogs' => $blogs,
        ]);
    }
    /**
     * @Route("/blog/{id}", name="blogs")
     */
    public function pages(PageBlog $pageBlog)
    {
        return $this->render('pages/pages.html.twig', [
            'blogs' => $pageBlog,
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit_p")
     *
     */
    public function editing ( PageBlog $blog, Request $request, $id )
    {    if($_POST) {

        $entityManager = $this->getDoctrine()->getManager();
        $page = $entityManager->getRepository(PageBlog::class)->find($id);

        $page->setTitlePage($request->request->get('pagetitle'));
        $page->setContentPage($request->request->get('contentpage'));
      // $d= $request->request->get('datepub');
      //  $page->setDatePub($page->getUpdated( $d));
        $entityManager->flush();
        return $this->redirectToRoute('blog');
      }

        return $this->render('pages/edit.html.twig', [
            'blogs' => $blog,
        ]);
    }
}
