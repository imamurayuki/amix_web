<?php

/**
 * BuildController
 *
 * @author Afrofair.inc
 */
class BuildController extends Controller
{
    /**
     * ただいま建築中(第一階層)
     *
     * @return void
     * @access public
     **/
    public function indexAction()
    {
        $data = $this->db_manager->get('Building')->findLists();
        $years = $this->db_manager->get('Building')->findAllYear();
        $_element = $this->getElement('sidebar', array(
            'base_url' => $this->request->getBaseUrl(),
            'data' => $data,
            'years' => $years,
        ));

        return $this->render(array('data' => $data, 'years' => $years, '_element' => $_element,
            'crumb' => Utils::getCrumb(array(
                array(
                    'url' => $this->request->getBaseUrl(),
                    'name' => 'ただいま建築中',
                ),
             )),
        ));
    }

    /**
     * 物件一覧/年度指定 (第二階層)
     *
     * @params array $params
     * @return void
     * @access public
     **/
    public function listAction($params) 
    {
        $Building = $this->db_manager->get('Building');
        $selectedYear = $params['year'];
        $data = $Building->findAllGroupByYear($selectedYear);

        if (!empty($data)) {
            $years = $Building->findAllYear();
            $_element = $this->getElement('sidebar2', array(
                'base_url' => $this->request->getBaseUrl(),
                'data' => $data, 'years' => $years, 'selectedYear' => $selectedYear,
            ));
            return $this->render(array(
                'data' => $data, '_element' => $_element,
                'years' => $years, 'selectedYear' => $selectedYear,
                'crumb' => Utils::getCrumb(array(
                    array(
                        'url' => $this->request->getBaseUrl(),
                        'name' => 'ただいま建築中',
                    ),
                    array('name' => "{$selectedYear}竣工"),
                )),
            ));
        } else {
            $this->forward404();
        }
    }

    /**
     * 物件詳細 (第三階層)
     *
     * @params array $params
     * @return void
     * @access public
     **/
    public function detailAction($params) 
    {
        $data = $this->db_manager->get('Building')->findById($params['id']);

        if (!empty($data)) {
            $data['detail'] = $this->db_manager->get('BuildingDetail')->
                findAllByBuildingIdAndStatus($params['id']);
            $Building = $this->db_manager->get('Building');
            $listItem = $Building->findLists();
            $years = $Building->findAllYear();
            $_element = $this->getElement('sidebar3', array(
                'base_url' => $this->request->getBaseUrl(),
                'listItem' => $listItem, 'years' => $years,
                'selected' => $params['id'],
            ));
            return $this->render(array(
                '_element' => $_element, 'data' => $data,
                'crumb' => Utils::getCrumb(array(
                    array(
                        'url' => $this->request->getBaseUrl(),
                        'name' => 'ただいま建築中',
                    ),
                    array('name' => Utils::truncate($data['name'], 15, '…')),
                )),
            ));
        } else {
            $this->forward404();
        }
    }
}
