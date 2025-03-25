<?php
namespace app\dataSource;

interface IDataSource{

    public function findAll($resource);

    public function findOne($resouerce,$field,$value);

    public function findMany($resource,$field,$operation,$value);

    public function create($resource, array $data);

    public function update($resource,array $data,$field,$value);

    public function delete($resource,$field,$value);
}










