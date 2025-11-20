<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\RefProductType;
use App\Form\RefServiceType;
use App\Repository\RefServiceRepository;
use App\Repository\RefProductRepository;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ReferenceController extends AbstractController
{
    private EntityManagerInterface $_em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    #[Route('/reference/list/service', name: 'app_reference_list_service'), IsGranted('ROLE_MANAGER')]
    public function listService(RefServiceRepository $refServiceRepository): Response
    {
        return $this->render('reference/list-service.html.twig', [
            'references' => $refServiceRepository->findAll(),
        ]);
    }

    #[Route('/reference/add/service', name: 'app_reference_add_service'), IsGranted('ROLE_MANAGER')]
    public function addService(Request $request, RefServiceRepository $refServiceRepository,
                               UtilityService $utilityService): Response
    {
        $form = $this->createForm(RefServiceType::class, null, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $service = $form->getData();
                $refService = strtoupper($service->getReference());
                $isExistsRefService = $refServiceRepository->findOneBy(['reference' => $refService]);

                if ($isExistsRefService) {
                    $this->addFlash('danger', 'Référence déjà utilisée.');
                } else {
                    $service->setCreatedAt(new \DateTime('now'));
                    $service->setReference($refService);

                    // Ajout de l'image
                    $photo = $form['picture']->getData();

                    if (!is_null($photo)) {
                        $file = new File($photo->getPathname());
                        $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                        $realPath = $_ENV['DIR_PHOTO'];
                        try {
                            $file->move($realPath, $fileName);
                            $service->setPicture($fileName);
                        }
                        catch (\Exception $e) {
                            $this->addFlash('danger', 'Echec de récupération de la photo.');
                        }
                    }

                    $this->_em->persist($service);
                    $this->_em->flush();
                    $this->addFlash('success', 'Service créé avec succès.');

                    return $this->redirectToRoute('app_reference_list_service');
                }
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création du service.');
            }
        }
        return $this->render('reference/add-service.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reference/edit/service/{id}', name: 'app_reference_edit_service'), IsGranted('ROLE_MANAGER')]
    public function editService(Request $request, RefServiceRepository $refServiceRepository,
                                UtilityService $utilityService, int $id): Response
    {
        $service = $refServiceRepository->find($id);
        $form = $this->createForm(RefServiceType::class, $service, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $service = $form->getData();
                $refService = strtoupper($service->getReference());
                $isExistsRefService = $refServiceRepository->findOneBy(['reference' => $refService]);

                if ($isExistsRefService and $id != $isExistsRefService->getId()) {
                    $this->addFlash('danger', 'Référence déjà attribuée.');
                } else {
                    $service->setReference($refService);

                    // --- Ajout de l'image debut ----
                    $photo = $form['picture']->getData();

                    if (!is_null($photo)) {
                        $file = new File($photo->getPathname());
                        $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                        $realPath = $_ENV['DIR_PHOTO'];
                        try {
                            $file->move($realPath, $fileName);
                            $service->setPicture($fileName);
                        }
                        catch (\Exception $e) {
                            $this->addFlash('danger', 'Echec de récupération de la photo.');
                        }
                    }
                    // --- fin traitement de l'image ----

                    $this->_em->flush();
                    $this->addFlash('success', 'Service modifié avec succès.');

                    return $this->redirectToRoute('app_reference_list_service');
                }
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification du service.');
            }
        }
        return $this->render('reference/edit-service.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reference/delete/service/{id}', name: 'app_reference_delete_service'), IsGranted('ROLE_ADMIN')]
    public function deleteService(Request $request, RefServiceRepository $refServiceRepository, int $id): Response
    {
        try {
            $service = $refServiceRepository->find($id);
            $this->_em->remove($service);
            $this->_em->flush();
            $this->addFlash('success', 'Service supprimé avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression du service.');
        }

        return $this->redirectToRoute('app_reference_list_service');
    }

    #[Route('/reference/list/product', name: 'app_reference_list_product'), IsGranted('ROLE_MANAGER')]
    public function listProduct(RefProductRepository $refProductRepository): Response
    {
        return $this->render('reference/list-product.html.twig', [
            'references' => $refProductRepository->findAll(),
        ]);
    }

    #[Route('/reference/add/product', name: 'app_reference_add_product'), IsGranted('ROLE_MANAGER')]
    public function addProduct(Request $request, UtilityService $utilityService): Response
    {
        $form = $this->createForm(RefProductType::class, null, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $product = $form->getData();
                $product->setCreatedAt(new \DateTime('now'));
                $product->setReference(strtoupper($product->getReference()));
                $product->setName(strtoupper($product->getName()));

                // Ajout de l'image
                $photo = $form['picture']->getData();

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $product->setPicture($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                }

                $this->_em->persist($product);
                $this->_em->flush();
                $this->addFlash('success', 'Produit créé avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création du produit.');
            }

            return $this->redirectToRoute('app_reference_list_product');
        }
        return $this->render('reference/add-product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reference/edit/product/{id}', name: 'app_reference_edit_product')]
    public function editProduct(Request $request, RefProductRepository $refProductRepository,
                                UtilityService $utilityService, int $id): Response
    {
        $product = $refProductRepository->find($id);
        $pictureSave = $product->getPicture();
        $form = $this->createForm(RefProductType::class, $product, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $product = $form->getData();
                $product->setReference(strtoupper($product->getReference()));
                $product->setName(strtoupper($product->getName()));

                // Ajout de l'image
                $photo = $form['picture']->getData();

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $product->setPicture($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                } else {
                    $product->setPicture($pictureSave);
                }

                $this->_em->flush();
                $this->addFlash('success', 'Produit modifié avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification du produit.');
            }

            return $this->redirectToRoute('app_reference_list_product');
        }
        return $this->render('reference/edit-product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reference/delete/product/{id}', name: 'app_reference_delete_product'), IsGranted('ROLE_ADMIN')]
    public function deleteProduct(Request $request, RefProductRepository $refProductRepository, int $id): Response
    {
        try {
            $product = $refProductRepository->find($id);
            $this->_em->remove($product);
            $this->_em->flush();
            $this->addFlash('success', 'Produit supprimé avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression du produit.');
        }

        return $this->redirectToRoute('app_reference_list_product');
    }

    #[Route('/reference/get/info/product', name: 'app_ajax_get_info_product')]
    public function getInfoRefProductAjax(Request $request, RefProductRepository $refProductRepository): JsonResponse
    {
        try {
            $refProduct = $request->get('id');
            //dump('refProduct', $refProduct);
            $tRefProduct = $refProductRepository->findBy(['reference' => $refProduct]);
            //dump('tRefProduct', $tRefProduct);

            return $this->json($tRefProduct);

        } catch (\Exception $exception) {
            //dump('exception', $exception->getMessage());
            return $this->json(false);
        }
    }

    #[Route('/reference/get/info/service', name: 'app_ajax_get_info_service')]
    public function getInfoRefServiceAjax(Request $request, RefServiceRepository $refServiceRepository): JsonResponse
    {
        try {
            $refService = $request->get('id');
            //dump('refService', $refService);
            $tRefService = $refServiceRepository->findBy(['reference' => $refService]);
            //dump('tRefService', $tRefService);

            return $this->json($tRefService);

        } catch (\Exception $exception) {
            //dump('exception', $exception->getMessage());
            return $this->json(false);
        }
    }
}
