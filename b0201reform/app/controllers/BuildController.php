<?php

/**
 * BuildController
 *
 * @author Afrofair.inc
 */
class BuildController extends Controller
{
    /**
     * リフォーム事例-外観(第一階層)
     *
     * @return void
     * @access public
     **/
    public function indexAction()
    {
        $data = $this->db_manager->get('Building')->findLists();
        $years = $this->db_manager->get('Building')->findAllYear();
        $_element = $this->getElement('sidebar_exterior', array(
            'base_url' => $this->request->getBaseUrl(),
            'data' => $data,
            'years' => $years,
        ));
        return $this->render(array('data' => $data, '_element' => $_element,
            'crumb' => Utils::getCrumb(array(
                array(
                    'url' => $this->request->getBaseUrl(),
                    'name' => 'リフォーム事例 [外観]',
                ),
             )),
        ));
    }

    /**
     * リフォーム事例-内装(第一階層)
     *
     * @return void
     * @access public
     **/
    public function interiorIndexAction()
    {
        $data = $this->db_manager->get('Building')->findLists(1);
        $years = $this->db_manager->get('Building')->findAllYear();
        $_element = $this->getElement('sidebar_interior', array(
            'base_url' => $this->request->getBaseUrl(),
            'data' => $data,
            'years' => $years,
        ));
        return $this->render(array('data' => $data, '_element' => $_element,
            'crumb' => Utils::getCrumb(array(
                array(
                    'url' => $this->request->getBaseUrl() . '/interior',
                    'name' => 'リフォーム事例 [内装]',
                ),
             )),
        ), 'interior_index');
    }

    /**
     * リフォーム事例-その他(第一階層)
     *
     * @return void
     * @access public
     **/
    public function otherIndexAction()
    {
        $data = $this->db_manager->get('Building')->findLists(2);
        $years = $this->db_manager->get('Building')->findAllYear();
        $_element = $this->getElement('sidebar_other', array(
            'base_url' => $this->request->getBaseUrl(),
            'data' => $data,
            'years' => $years,
        ));
        return $this->render(array('data' => $data, '_element' => $_element,
            'crumb' => Utils::getCrumb(array(
                array(
                    'url' => $this->request->getBaseUrl() . '/other',
                    'name' => 'リフォーム事例 [その他]',
                ),
             )),
        ), 'other_index');
    }

    /**
     * 物件一覧/年度指定-外観 (第二階層)
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
                        'name' => 'アミックスのリフォーム事例',
                    ),
                    array('name' => "{$selectedYear}年リフォーム"),
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
            $listInteriorItem = $Building->findLists(1);
            $listOtherItem = $Building->findLists(2);

            $years = $Building->findAllYear();
            $_element = $this->getElement('sidebar3', array(
                'base_url' => $this->request->getBaseUrl(),
				'listItem' => $listItem, 'listInteriorItem' => $listInteriorItem, 'listOtherItem' => $listOtherItem,
				'years' => $years, 'data' => $data,
                'selected' => $params['id'],
            ));
			$crumbName = 'リフォーム事例 [外観]';
			if ($data['is_interior'] == 1) {
				$crumbName = 'リフォーム事例 [内装]';
			}
			if ($data['is_interior'] == 2) {
				$crumbName = 'リフォーム事例 [その他]';
			}
            return $this->render(array(
                '_element' => $_element,
                'title' => $data['name'],
                'data' => $data,
                'crumb' => Utils::getCrumb(array(
                    array(
                        'url' => $this->request->getBaseUrl(),
                        'name' => $crumbName,
                    ),
                    array('name' => Utils::truncate($data['name'], 15, '…')),
                )),
            ));
        } else {
            $this->forward404();
        }
    }
}
