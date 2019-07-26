<?php

namespace App\Controller;

use App\Entity\PageBlog;
use App\Form\BlogAddType;
use App\Repository\PageBlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @var  EntityManagerInterface
     */
    private $entityManager;
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
    /**
     * @Route("/add/blog", name="add_blog")
     */
    public function addP (Request $request)
    {
        $blogs=new PageBlog();
        $form= $this->createForm(BlogAddType::class, $blogs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($blogs);
            $this->entityManager->flush();

            return $this->redirectToRoute('blog');
        }
        return $this->render('pages/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
