<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Keyword;
use AppBundle\Entity\Link;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \DateTime;
class SearchController extends Controller {

    /**
     * @Route("/admin/keywords", name="keywords")
     */
    public function indexAction(Request $request) {

        $keywords = $this->getDoctrine()
                ->getRepository(Keyword::class)
                ->findBy(array(), array('hasresults' => 'asc', 'date' => 'desc'));

        return $this->render('admin/keywords.html.twig', [
                    'keywords' => $keywords,
        ]);
    }

    /**
     * @Route("/admin/search", name="search")
     */
    public function searchAction(Request $request) {
        $param = explode('=', $request->getRequestUri());
        $keywords = $param[1];
        if (null !== $keywords) {
            $keywords = preg_replace('/\+/', '%', $keywords);
            $em = $this->getDoctrine()->getRepository(Link::class);

            $qb = $em->createQueryBuilder('l');
            $query = $qb->where($qb->expr()->orX(
                                    $qb->expr()->like('l.name', ':keyword')
                    ))
                    ->orWhere($qb->expr()->like('l.url', ':keydesc'))
                    ->setParameter('keyword', '%' . $keywords . '%')
                    ->setParameter('keydesc', '%' . $keywords . '%')
                    ->getQuery();

            $websites = $query->getResult();
            $nbResult = count($query->getScalarResult());
            $keywords = preg_replace('/\%/', ' ', $keywords);

            $key = $this->getDoctrine()->getRepository(Keyword::class)
                    ->findBy(array('word' => $keywords));

            $emKey = $this->getDoctrine()->getManager();
            if (count($key) > 0) {
                //  die(var_dump($key[0]->getOccurence()+1));

                $key[0]->setOccurence($key[0]->getOccurence() + 1);
                if ($nbResult > 0) {
                    $key[0]->setHasResult(1);
                }
                $emKey->persist($key[0]);
                $emKey->flush();
            } else {
                $key = new Keyword();
                $key->setDate(new DateTime());
                if ($nbResult > 0) {
                    $key->setHasresults(1);
                } else {
                    $key->setHasresults(0);
                }
                $key->setOccurence(1);
                $key->setWord($keywords);
                $emKey->persist($key);
                $emKey->flush();
            }
            // die(var_dump()));
            return $this->render('search/index.html.twig', [
                        'webSites' => $websites,
                        'keys' => $keywords,
                        'nbRes' => $nbResult,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

}
