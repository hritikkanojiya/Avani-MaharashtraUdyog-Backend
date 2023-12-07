<?php

/**
 * 
 *
 * @package		Master
 * @subpackage           model
 * @since		Version 1.0
 * @purpose              To handle Master model for administrator
 */
class Master_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    /**
     * master_insert method 
     *
     * @access	public
     * @param	array data
     * @param	string tablename
     * @return	int last inserted id
     */
    public function master_insert($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    /**
     * Common functionality to insert all post data in the required table
     * @access public
     * @param array $data (containing values to be added to table)
     * $param string $company(Company name)
     * @return function insert_id (returns last insert id of the company)
     */
    public function master_postdata_insert($tablename, $postData)
    {
        $fields = $this->db->list_fields($tablename);
        foreach ($postData as $key => $val) {
            if (in_array($key, $fields)) {
                $data[$key] = $val;
            }
        }
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    function master_batch_insert($tablename, $arrData)
    {
        if ($arrData) {
            if ($this->db->insert_batch($tablename, $arrData)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    public function master_postdata_update($tablename, $postData, $where = false)
    {
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
            $fields = $this->db->list_fields($tablename);
            foreach ($postData as $key => $val) {
                if (in_array($key, $fields)) {
                    $data[$key] = $val;
                }
            }
            $this->db->update($tablename, $data);
        }
        return true;
    }
    /**
     * master_update method 
     *
     * @access	public
     * @param	array data
     * @param	string tablename
     * @param	array where
     * @return	bool true/false
     */
    public function master_update($tablename, $data, $where = false)
    {
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
            $this->db->update($tablename, $data);
        }
        return true;
    }
    /**
     * master_delete method 
     *
     * @access	public
     * @param	array data
     * @param	string tablename
     * @return	bool true/false
     */
    public function master_delete($tablename, $where = false)
    {
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
            $this->db->delete($tablename);
            return true;
        }
    }
    /**
     * master_get method 
     *
     * @access  public
     * @param   array join
     * @param   string tablename
     * @param   string where
     * @param   arrayOrObject -- 0 - single object, 1 - single array, 2 multidimentional array 
     * @return  array result set,
     */
    public function master_get($tablename, $where = false, $select = false, $result_count = false, $arrayOrObject = 0, $join = false, $perpage = false, $search = false, $group_by = false, $distinct = false, $like = false, $order_by = false, $order_by_field_name = false)
    {
        /*==== Where Clause ===*/
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
        }
        /*==== Order by Clause ===*/
        if ($order_by && $order_by_field_name) {
            $this->db->order_by($order_by_field_name, $order_by);
        }
        /*==== Join Clause ===*/
        if ($join) {
            if (count($join) > 0) {
                foreach ($join as $key => $value) {
                    $explode = explode('|', $value);
                    $this->db->join($key, $explode[0], $explode[1]);
                }
            }
        }
        /*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select, FALSE);
        } else {
            $this->db->select('*');
        }
        /*==== Result set Count Clause ===*/
        if ($result_count) {
            $this->db->from($tablename);
            return $this->db->count_all_results();
        }
        /*==== Perpage Clause ===*/
        if ($perpage) {
            $this->db->limit($perpage);
        }
        /*==== Group by Clause ===*/
        if ($group_by) {
            if (is_array($group_by)) {
                $this->db->group_by($group_by);
            } else {
                $this->db->group_by($group_by);
            }
        }
        /*==== Distinct Clause ===*/
        if ($distinct) {
            $this->db->distinct();
        }
        /*==== Like Clause ===*/
        if ($like) {
            foreach ($like as $key => $value) {
                $this->db->like($key, $value);
            }
        }
        $query = $this->db->get($tablename);
        /*==== Return Clause ===*/
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        if ($arrayOrObject > 1) {
            return $query->result_array();
        }
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        if ($query->num_rows() > 1) {
            return $query->result_array();
        }
    }
    /**
     * master_pagination method 
     * 	Get the list with pagination
     * @access	public
     * @param	string condition (rows->return single row,result_set->return reult with pagination,rows->return total count)
     * @param	string field (specifcy column name for sorting)
     * @param	string order (specifcy asc/desc for column)
     * @param	string offset (specifcy offset for pagination result set)
     * @param	string perpage (specifcy perpage for pagination result set)
     * @param	string table (specifcy table name for result set)
     * @param	array search (specifcy search array for searching)
     * @param	array join (specifcy join array for join operation)
     * @param	array where (specifcy where array for where clause)
     * @param	string select (specifcy number of column to return in result set)
     * @return	array result set
     */
    public function master_pagination($tablename, $where = false, $select = false, $result_count = false, $offset = 0, $join = false, $perpage = false, $search = false, $group_by = false, $distinct = false, $like = false, $order_by = false, $order_by_field_name = false)
    {
        /*==== Pagination offset Clause ===*/
        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'] + 0;
        }
        /*==== Order by Filter Clause ===*/
        if (isset($_GET['field']) && $_GET['field'] != '') {
            $order_by_field_name = $_GET['field'];
            $order_by = $_GET['order'];
        }
        /*==== Where Clause ===*/
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
        }
        /*==== Join Clause ===*/
        if ($join) {
            if (count($join) > 0) {
                foreach ($join as $key => $value) {
                    $explode = explode('|', $value);
                    $this->db->join($key, $explode[0], $explode[1]);
                }
            }
        }
        /*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select, FALSE);
        } else {
            $this->db->select('*');
        }
        /*==== Group by Clause ===*/
        if ($group_by) {
            if (is_array($group_by)) {
                $this->db->group_by($group_by);
            } else {
                $this->db->group_by($group_by);
            }
        }
        /*==== Distinct Clause ===*/
        if ($distinct) {
            $this->db->distinct();
        }
        /*==== Result set Count Clause ===*/
        if ($result_count) {
            if ($search) {
                $search_where = $this->searchString($search);
                $this->db->where($search_where, NULL, FALSE);
            }
            $this->db->from($tablename);
            if ($group_by) {
                $query = $this->db->get();
                $num_rows = $query->num_rows();
                return $num_rows;
            }
            return $this->db->count_all_results();
        }
        /*==== Search and Orderby Pagination  ===*/
        if ($search && $order_by_field_name) {
            $search_where = $this->searchString($search);
            $this->db->order_by($order_by_field_name, $order_by);
            $query = $this->db->get_where($tablename, $search_where, $perpage, $offset);
        }
        /*==== Only Search Pagination only  ===*/ elseif ($search && !$order_by_field_name) {
            $search_where = $this->searchString($search);
            $query = $this->db->get_where($tablename, $search_where, $perpage, $offset);
        }
        /*==== Only Order clause Pagination only  ===*/ elseif ($order_by_field_name) {
            $this->db->order_by($order_by_field_name, $order_by);
            $query = $this->db->get($tablename, $perpage, $offset);
        }
        /*==== Default Pagination  ===*/ else {
            $query = $this->db->get($tablename, $perpage, $offset);
        }
        /*==== Return Clause ===*/
        if ($query->num_rows() > 0) {
            // print_r($query->result_array());
            return $query->result_array();
        }
        if ($query->num_rows() == 0) {
            return FALSE;
        }
    }
    /**
     * searchString method 
     * 	Searching the string 
     * @access	public
     * @param	array search
     * @return	string search keywords
     */
    public function searchString($search)
    {
        $searchstring = "";
        $count = 1;
        foreach ($search as $key => $value) {
            if (count($search) != $count) {
                if ($count == 1) {
                    $searchstring = "(";
                }
                $searchstring .= "$key LIKE '%$value%' OR ";
            } else {
                if (count($search) == $count + 1) {
                    $searchstring .= "$key LIKE '%$value%' ";
                } else {
                    $searchstring .= "$key LIKE '%$value%') ";
                }
            }
            $count++;
        }
        return $searchstring;
    }
    public function master_query($sql, $result_count = false, $offset = 0, $perpage = false)
    {
        /*==== Pagination offset Clause ===*/
        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'] + 0;
        }
        if ($perpage) {
            $sql .= " LIMIT $offset,$perpage";
        }
        $query = $this->db->query($sql);
        /*==== Return Clause ===*/
        if ($result_count) {
            $num_rows = $query->num_rows();
            return $num_rows;
        }
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    /**
     * master_max_id method 
     *
     * @access	public
     * @param	string column name
     * @param	string tablename
     * @return	array
     */
    public function master_max_id($column_name, $tablename)
    {
        $this->db->select_max($column_name);
        $query = $this->db->get($tablename);
        $row = $query->row_array();
        return $row[$column_name];
    }
    /**
     * master_custom_query method 
     *
     */
    public function master_custom_query($query)
    {
        $query_obj = $this->db->query($query);
        return $query_obj;
    }
    /**
     * advance_master_get method 
     *
     */
    public function advance_master_get($tablename, $where = false, $select = false, $result_count = false, $is_return_row_array = false, $join = false, $perpage = false, $search = false, $group_by = false, $distinct = false, $like = false, $order_by = false, $order_by_field_name = false)
    {
        /*==== Where Clause ===*/
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
        }
        /*==== Order by Clause ===*/
        if ($order_by && $order_by_field_name) {
            $this->db->order_by($order_by_field_name, $order_by);
        }
        /*==== Join Clause ===*/
        if ($join) {
            if (count($join) > 0) {
                foreach ($join as $key => $value) {
                    $explode = explode('|', $value);
                    $this->db->join($key, $explode[0], $explode[1]);
                }
            }
        }
        /*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select, FALSE);
        } else {
            $this->db->select('*');
        }
        /*==== Result set Count Clause ===*/
        if ($result_count) {
            $this->db->from($tablename);
            return $this->db->count_all_results();
        }
        /*==== Perpage Clause ===*/
        if ($perpage) {
            $this->db->limit($perpage);
        }
        /*==== Group by Clause ===*/
        if ($group_by) {
            if (is_array($group_by)) {
                $this->db->group_by($group_by);
            } else {
                $this->db->group_by($group_by);
            }
        }
        /*==== Distinct Clause ===*/
        if ($distinct) {
            $this->db->distinct();
        }
        /*==== Like Clause ===*/
        if ($like) {
            foreach ($like as $key => $value) {
                $this->db->like($key, $value);
            }
        }
        $query = $this->db->get($tablename);
        /*==== Return Clause ===*/
        if ($is_return_row_array == FALSE) {
            return $query->result_array();
        } else {
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
            if ($query->num_rows() > 1) {
                return $query->result_array();
            }
        }
    }
}
