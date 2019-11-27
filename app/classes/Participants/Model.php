<?php

namespace App\Participants;

use \App\App;

class Model {

    private $table_name = 'Comments';

    public function __construct() {
        App::$db->createTable($this->table_name);
    }

    /**
     * Irašo $comment i duombaze
     * @param Participant $comment
     * @return bool
     */
    public function insert(Participant $comment) {
        return App::$db->insertRow($this->table_name, $comment->getData());
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function get($conditions = []) {
        $comments = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
            $comments[] = new Participant($row_data);
        }
        
        return $comments;
    }

    /**
     * @param Participant $comment
     * @return bool
     */
    public function update(Participant $comment) {
        return App::$db->updateRow($this->table_name, $comment->getId(), $comment->getData());
    }

    /**
     * deletes all cars from database
     * @param Participant $comment
     * @return bool
     */
    public function delete(Participant $comment) {
        return App::$db->deleteRow($this->table_name, $comment->getId());
    }

    public function __destruct() {
        App::$db->save();
    }

}
