<?php
namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route("/", name: "produit_index")]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route("/produit/{id}", name: "produit_show")]
    public function show(int $id, ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->find($id);

        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route("/search", name: "produit_search")]
    public function search(): Response
    {
        return $this->render('produit/search.html.twig');
    }

    // Ajout de la route pour les produits pour homme
    #[Route("/produits/homme", name: "produit_homme")]
    public function homme(ProduitRepository $produitRepository): Response
    {
        // Récupérer les produits pour homme. Vous pouvez ajouter un filtre ici.
        $produitsHomme = $produitRepository->findByCategory('homme');

        return $this->render('produit/homme.html.twig', [
            'produits' => $produitsHomme,
        ]);
    }

    // Ajout de la route pour les produits pour femme
    #[Route("/produits/femme", name: "produit_femme")]
    public function femme(ProduitRepository $produitRepository): Response
    {
        // Récupérer les produits pour femme. Vous pouvez ajouter un filtre ici.
        $produitsFemme = $produitRepository->findByCategory('femme');

        return $this->render('produit/femme.html.twig', [
            'produits' => $produitsFemme,
        ]);
    }

    // Ajout de la route pour les produits pour bébé
    #[Route("/produits/bebe", name: "produit_bebe")]
    public function bebe(ProduitRepository $produitRepository): Response
    {
        // Récupérer les produits pour bébé. Vous pouvez ajouter un filtre ici.
        $produitsBebe = $produitRepository->findByCategory('bebe');

        return $this->render('produit/bebe.html.twig', [
            'produits' => $produitsBebe,
        ]);
    }
    // Ajout de la route pour les produits pour enfants
#[Route("/produits/enfants", name: "produit_enfant")]
public function enfant(ProduitRepository $produitRepository): Response
{
    // Récupérer les produits pour enfants. Vous pouvez ajouter un filtre ici.
    $produitsEnfant = $produitRepository->findByCategory('enfant');

    return $this->render('produit/enfant.html.twig', [
        'produits' => $produitsEnfant,
    ]);
}


}
