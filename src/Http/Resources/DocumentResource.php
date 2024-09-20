<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Documents\CreateDocumentRequest;
use Perscom\Http\Requests\Documents\DeleteDocumentRequest;
use Perscom\Http\Requests\Documents\GetDocumentRequest;
use Perscom\Http\Requests\Documents\GetDocumentsRequest;
use Perscom\Http\Requests\Documents\SearchDocumentsRequest;
use Perscom\Http\Requests\Documents\UpdateDocumentRequest;
use Saloon\Contracts\Response;

class DocumentResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetDocumentsRequest($include, $page, $limit));
    }

    /**
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  ScopeObject|array<ScopeObject>|null  $scope
     * @param  string|array<string>  $include
     */
    public function search(
        ?string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        mixed $scope = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchDocumentsRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetDocumentRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateDocumentRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateDocumentRequest($id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteDocumentRequest($id));
    }
}
