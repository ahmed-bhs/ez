<?php declare(strict_types=1);

namespace AppBundle\Controller;

use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause;
use eZ\Publish\Core\MVC\Symfony\Controller\Controller;
use eZ\Publish\Core\Pagination\Pagerfanta\LocationSearchAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class Homepage.
 */
class HomepageController extends Controller
{
    public function getAllRidesAction(?int $page = 1)
    {
        $repository = $this->getRepository();
        $locationService = $repository->getLocationService();
        $rootLocationId = $this->getConfigResolver()->getParameter('content.tree_root.location_id');
        $rootLocation = $locationService->loadLocation($rootLocationId);

        return $this->render(
            '@ezdesign/list/rides.html.twig',
            [
                'pagerRides' => $this->findRides($rootLocation, $page),
                'location' => $rootLocation,
            ]
        );
    }

    /**
     * @param Location $rootLocation
     * @param $page
     *
     * @return Pagerfanta
     */
    private function findRides(Location $rootLocation, $page)
    {
        /*Query construction */
        $query = new LocationQuery();
        $query->query = new Criterion\LogicalAnd(
            [
                new Criterion\Subtree($rootLocation->pathString),
                new Criterion\Visibility(Criterion\Visibility::VISIBLE),
                new Criterion\ContentTypeIdentifier(['ride'])
            ]
        );

        $query->sortClauses = [
            new SortClause\DatePublished(LocationQuery::SORT_ASC),
        ];

        $pager = new Pagerfanta(
            new LocationSearchAdapter($query, $this->getRepository()->getSearchService())
        );

        $pager->setMaxPerPage(1);
        $pager->setCurrentPage($page);

        return $pager;

    }
}