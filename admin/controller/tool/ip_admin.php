<?php    
class ControllerToolIpAdmin extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->load->language('tool/ip_admin');
		 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/ip_admin');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->load->language('tool/ip_admin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/ip_admin');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	$this->model_tool_ip_admin->addAdminWhitelist($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';
							
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    	
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->load->language('tool/ip_admin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/ip_admin');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tool_ip_admin->editAdminWhitelist($this->request->get['admin_ip_whitelist_id'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
						
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->load->language('tool/ip_admin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/ip_admin');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $admin_ip_whitelist_id) {
				$this->model_tool_ip_admin->deleteAdminWhitelist($admin_ip_whitelist_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
						
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
    
    	$this->getList();
  	}  
    
  	private function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ip'; 
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('tool/ip_admin/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('tool/ip_admin/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['admin_whitelists'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$admin_whitelist_total = $this->model_tool_ip_admin->getTotalAdminWhitelists($data);
	
		$results = $this->model_tool_ip_admin->getAdminWhitelists($data);
 
    	foreach ($results as $result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('tool/ip_admin/update', 'token=' . $this->session->data['token'] . '&admin_ip_whitelist_id=' . $result['admin_ip_whitelist_id'] . $url, 'SSL')
			);
			
			$this->data['admin_whitelists'][] = array(
				'admin_ip_whitelist_id' => $result['admin_ip_whitelist_id'],
				'ip'                       => $result['ip'],
				'selected'                 => isset($this->request->post['selected']) && in_array($result['admin_ip_whitelist_id'], $this->request->post['selected']),
				'action'                   => $action
			);
		}	
					
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['entry_ip_admin'] = $this->language->get('entry_ip_admin');
		$this->data['column_ip'] = $this->language->get('column_ip');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$url = '';
			
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_ip'] = $this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . '&sort=ip' . $url, 'SSL');
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $admin_whitelist_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
				
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'tool/ip_admin_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
  
  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 		
    	$this->data['entry_ip'] = $this->language->get('entry_ip');
 
		$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['ip'])) {
			$this->data['error_ip'] = $this->error['ip'];
		} else {
			$this->data['error_ip'] = '';
		}
		
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
						
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['admin_ip_whitelist_id'])) {
			$this->data['action'] = $this->url->link('tool/ip_admin/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('tool/ip_admin/update', 'token=' . $this->session->data['token'] . '&admin_ip_whitelist_id=' . $this->request->get['admin_ip_whitelist_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('tool/ip_admin', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['admin_ip_whitelist_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$admin_whitelist_info = $this->model_tool_ip_admin->getAdminWhitelist($this->request->get['admin_ip_whitelist_id']);
    	}
			
    	if (isset($this->request->post['ip'])) {
      		$this->data['ip'] = $this->request->post['ip'];
		} elseif (!empty($admin_whitelist_info)) { 
			$this->data['ip'] = $admin_whitelist_info['ip'];
		} else {
      		$this->data['ip'] = '';
    	}
		
		$this->template = 'tool/ip_admin_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
			 
  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'tool/ip_admin')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((utf8_strlen($this->request->post['ip']) < 1) || (utf8_strlen($this->request->post['ip']) > 15)) {
      		$this->error['ip'] = $this->language->get('error_ip');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'tool/ip_admin')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}	
	  	 
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  
  	} 
}
?>