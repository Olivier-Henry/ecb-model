<?php
/**
 * Interface pour une implémentation du pattern DAO
 */
interface IDAO {
    public function findAll();
    public function findOneByPk($pk);
    public function find(array $data);
    public function deleteByPk($pk);
    public function save($dto);
}
