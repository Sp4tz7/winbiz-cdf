<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductTemplate;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductTemplateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RequestStack;


class WinbizManager
{

    const _SUCCESS_ = '#SUCCESS# ';
    const _FAILURE_ = '#FAILURE# ';
    const _FAILURE_METHOD = '#FAILURE# METHOD DOES NOT EXISTS';
    const _FAILURE_NO_ACTION = '#FAILURE# ACTION NOT PROVIDEN';

    private $container;
    private $requestStack;
    private $entityManager;

    public function __construct(
        ContainerInterface $container,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductTemplateRepository $productTemplateRepository
    ) {

        $this->container = $container;
        $this->requestStack = $requestStack;
        $this->filesystem = new Filesystem();
        $this->entityManager = $entityManager;
        $this->CategoryRepository = $categoryRepository;
        $this->ProductRepository = $productRepository;
        $this->ProductTemplateRepository = $productTemplateRepository;
    }

    public function getAction()
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request->query->has('action')) {
            $action = $this->camelize($request->query->get('action'));

            return method_exists($this,
                $action) ? $this->{$action}() : $this->logThis($action.' - '.self::_FAILURE_METHOD);
        } else {
            return $this->logThis([self::_FAILURE_NO_ACTION, $_REQUEST]);
        }
    }

    public function camelize($input, $separator = '_')
    {

        return str_replace($separator, '', ucwords($input, $separator));
    }

    public function logThis($data)
    {
        $info = "info: ".$_SERVER['REMOTE_ADDR'].' - '.$_SERVER['REQUEST_URI'].' - '.date("F j, Y, g:i a").PHP_EOL.
            "data: ".json_encode($data).PHP_EOL.
            "-------------------------".PHP_EOL;
        file_put_contents('./logs/logthis_'.date("d.m.Y").'.txt', $info, FILE_APPEND);

        return json_encode($data);
    }

    private function GetScriptVersion()
    {
        $version = self::_SUCCESS_.$this->container->getParameter('app.version');
        $this->logThis($version);

        return $version;
    }

    private function ImportManufacturers()
    {
        $this->logThis('ImportManufacturers - SUCCESS');

        return self::_SUCCESS_;
    }

    private function GetDefaultCurrency()
    {
        return self::_SUCCESS_;
    }

    private function ImportProducts()
    {

        if (!$file = $this->getTextFile('import_products')) {
            return self::_ERROR_;
        }

        $file_data = $this->getFileData($file);

        foreach ($file_data as $data) {

            preg_match('/\d*/', $data[2], $winbiz_main_id);


            $product_template = $this->ProductTemplateRepository->findOneBy(['winbiz_main_code' => $data[2]]);
            $product_template = $product_template?? new ProductTemplate();
            $product_template->setWinbizMainCode($winbiz_main_id[0]);
            $this->entityManager->persist($product_template);

            $product = $this->ProductRepository->findOneBy(['winbiz_id' => $data[0]]);
            $product_entity = $product ?? new Product();
            $product_entity->setWinbizId($data[0]);
            $product_entity->setWinbizMainCode($product_template);
            $product_entity->setQuantity($data[1]);
            $product_entity->setItemCode($data[2]);
            $product_entity->setPictures($data[3]);
            $product_entity->setPrice($data[4]);
            $product_entity->setNameFr($data[11]);
            $product_entity->setNameDe($data[12]);
            $product_entity->setNameIt($data[13]);
            $product_entity->setNameEn($data[14]);
            $product_entity->setDescriptionFr($data[16]);
            $product_entity->setDescriptionDe($data[17]);
            $product_entity->setDescriptionIt($data[18]);
            $product_entity->setDescriptionEn($data[19]);
            $this->entityManager->persist($product_entity);
            $this->entityManager->flush();
        }

        $this->logThis('ImportProduct - SUCCESS');

        return self::_SUCCESS_;

    }

    private function getTextFile($file_name, $ext = 'txt')
    {
        $file = $this->container->getParameter('app.data_upload_directory').'/'.$file_name.'.'.$ext;

        return $this->filesystem->exists($file) ? $file : false;

    }

    private function getFileData($file)
    {

        $handle = @fopen($file, "r");
        $file_data = [];
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $line = explode(';', $buffer);
                array_push($file_data, $line);
            }
            if (!feof($handle)) {
                return false;
            }
            fclose($handle);

            return $file_data;

        }

        return false;
    }

    private function ImportProductsCategories()
    {
        return self::_SUCCESS_;
    }

    private function UpdateProductsQuantity()
    {
        return self::_SUCCESS_;
    }

    private function ImportTaxes()
    {
        return self::_SUCCESS_;
    }

    private function UpdateProductsPrice()
    {
        return self::_SUCCESS_;
    }

    private function ImportCategories()
    {
        if (!$file = $this->getTextFile('import_categories')) {
            return self::_ERROR_;
        }

        $file_data = $this->getFileData($file);

        foreach ($file_data as $data) {
            $category = $this->CategoryRepository->findOneBy(['winbiz_id' => $data[0]]);

            $categoryEntity = $category ?? new Category();
            $categoryEntity->setWinbizId($data[0]);
            $categoryEntity->setParentId($data[1]);
            $categoryEntity->setSortOrder($data[2]);
            $categoryEntity->setNameFr($data[3]);
            $categoryEntity->setNameDe($data[4]);
            $categoryEntity->setNameIt($data[5]);
            $categoryEntity->setPicture($data[14]);
            $this->entityManager->persist($categoryEntity);
            $this->entityManager->flush();
        }


        $this->logThis('ImportCategory - SUCCESS');

        return self::_SUCCESS_;
    }

}