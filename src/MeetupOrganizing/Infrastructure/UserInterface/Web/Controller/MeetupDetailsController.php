<?php
declare(strict_types = 1);

namespace MeetupOrganizing\Infrastructure\UserInterface\Web\Controller;

use MeetupOrganizing\Domain\Model\MeetupId;
use MeetupOrganizing\Infrastructure\Persistence\Filesystem\MeetupRepositoryFilesystem;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

final class MeetupDetailsController
{
    /**
     * @var MeetupRepositoryFilesystem
     */
    private $meetupRepository;

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(MeetupRepositoryFilesystem $meetupRepository, TemplateRendererInterface $renderer)
    {
        $this->meetupRepository = $meetupRepository;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null): ResponseInterface
    {
        $meetup = $this->meetupRepository->byId(MeetupId::fromString($request->getAttribute('id')));

        $response->getBody()->write($this->renderer->render('meetup-details.html.twig', [
            'meetup' => $meetup
        ]));

        return $response;
    }
}
