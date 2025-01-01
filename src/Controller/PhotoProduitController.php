<?php
namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoProduitController extends AbstractController
{
   #[Route("/produit/{id}/gallery", name:"photoProduit_gallery")]
     
    public function gallery(Produit $produit): Response
    {
        return $this->render('photoProduit/gallery.html.twig', [
            'produit' => $produit,
        ]);
    }
}
