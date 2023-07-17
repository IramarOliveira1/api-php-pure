<?php

namespace App\Services;

use App\Interface\GenericInterface;
use App\Repositories\CaracteristicRepository;
use App\Repositories\ProductRepository;
use Exception;

class ProductService extends GenericService implements GenericInterface
{
    private $repository;

    private $caracteristic;

    public function __construct()
    {
        $this->repository = new ProductRepository;
        $this->caracteristic = new CaracteristicRepository;
    }

    public function all()
    {
        return $this->repository->findAll();
    }

    public function index($id)
    {
        return $this->repository->findOne($id);
    }

    public function store($request)
    {
        try {
            $image = $this->uploadImage();

            $mountedObject = $this->mountedObject($request, $image);

            $product = $this->createOrUpdate($mountedObject);

            $this->repository->save($product);

            return json_encode(['message' => 'Produto criado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function update($request, $id)
    {
        try {
            $find = $this->repository->findOne($id);

            $this->deleteImage($find);

            $image = $this->uploadImage();

            $mountedObject = $this->mountedObject($request, $image);

            $product = $this->createOrUpdate($mountedObject);

            $this->repository->update($product, $id);

            return json_encode(['message' => 'Produto atualizado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function deleteImage($find)
    {
        $exists = file_exists($_SERVER['DOCUMENT_ROOT'] . $find[0]['url_imagem']);

        if ($exists) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $find[0]['url_imagem']);
        }
    }

    public function delete($id)
    {
        try {
            $product = $this->repository->findOne($id);

            $this->deleteImage($product);

            $this->repository->destroy($id);

            $this->caracteristic->destroy($product[0]['id_caracteristica']);

            return json_encode(['message' => 'Produto excluido com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function createOrUpdate($request)
    {
        $object = json_decode(json_encode($request));

        try {
            if ($object->product->id_caracteristica) {
                $caracteristic = $this->mountedUpdate($object->caracteristic);
                $this->caracteristic->update($caracteristic, $object->product->id_caracteristica);

                $product = $this->mountedUpdate($object->product);

                return $product;
            }

            $caracteristic = $this->request($object->caracteristic);

            $id_caracteristic = $this->caracteristic->save($caracteristic);

            $object->product->id_caracteristica = $id_caracteristic;

            $product = $this->request($object->product);

            return $product;
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function mountedObject($request, $image)
    {
        return [
            'product' => [
                'nome' => $request['nome'],
                'descricao' => $request['descricao'],
                'url_imagem' => $image['name'] . ".{$image['extension']}",
                'preco' => $request['preco'],
                'id_caracteristica' => $request['id_caracteristica'] ?? null,
            ],
            'caracteristic' => [
                'modelo' => $request['modelo'],
                'fabricante' => $request['fabricante'],
                'cor' => $request['cor'],
                'codigo' => $request['codigo'],
            ]
        ];
    }

    public function uploadImage()
    {
        try {
            $dir_exists = is_dir($_SERVER['DOCUMENT_ROOT'] . '/assets/image');

            if (!$dir_exists) {
                chmod($_SERVER['DOCUMENT_ROOT'], 0755);
                mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/image', 0777, true);
            }

            $extension = pathinfo($_FILES['url_imagem']['name'], PATHINFO_EXTENSION);

            $_FILES['url_imagem']['name'] = time();

            $upload = move_uploaded_file($_FILES['url_imagem']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/assets/image/{$_FILES['url_imagem']['name']}" . ".{$extension}");

            return ['name' => "/assets/image/{$_FILES['url_imagem']['name']}", 'extension' => $extension, 'upload' => $upload];
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
