<?php

namespace AppBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause;
use eZ\Publish\Core\MVC\Symfony\View\ContentView;
use eZ\Publish\Core\Pagination\Pagerfanta\LocationSearchAdapter;
use Pagerfanta\Pagerfanta;

class RideController extends Controller
{
    public function getAllRidesAction(ContentView $view)
    {
        $repository = $this->getRepository();
        $locationService = $repository->getLocationService();
        $rootLocationId = $this->getConfigResolver()->getParameter('content.tree_root.location_id');
        $rootLocation = $locationService->loadLocation($rootLocationId);

        $view->addParameters(
            [
                'pagerRides' => $this->findRides($rootLocation, $view->getParameter('page')),
                'location' => $rootLocation,
            ]
        );

        return $view;
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

    /**
     * Action used to display a ride
     *    - Adds the list of all related Landmarks to the response.
     *
     * @param ContentView $view
     *
     * @return ContentView $view
     */
    public function viewRideWithLandmarksAction(ContentView $view)
    {
        $repository = $this->getRepository();
        $contentService = $repository->getContentService();
        $currentContent = $view->getContent();
        $landmarksListId = $currentContent->getFieldValue('landmarks');
        $landmarksList = [];

        foreach ($landmarksListId->destinationContentIds as $landmarkId) {
            $landmarksList[$landmarkId] = $contentService->loadContent($landmarkId);
        }

        $view->addParameters(['landmarksList' => $landmarksList]);

        return $view;
    }
}
