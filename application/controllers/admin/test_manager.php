<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_manager extends CI_Controller {   

	/**

	 * Index Page for this controller.

	 * 

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome 

	 *	- or -  

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/ 

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name> 

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	function __construct()  

	{
		parent::__construct();
		if(!$this->session->userdata('user_id')) redirect('admin/auth');
		$this->load->model('admin/test_model');			
	}
	
	function edit($testid,$lang_code)
	{
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();
		if(!(in_array($lang_code,$access_language))) redirect('admin/tests'); 
		
		if($this->input->post('test_edit'))
		{
			
			$test_info['title']=$this->input->post('title');
			//$test_info['sub_title']=$this->input->post('sub_title');
			$test_info['page_title']=$this->input->post('page_title');
			$test_info['description']=$this->input->post('description'); 
			$test_info['fbshare_des']=$this->input->post('fbshare_des');
			$test_info['result_text']=$this->input->post('result_text');
			
			$testid=$this->input->post('testid');
			$lang_code=$this->input->post('lang_code');
			
			$testinfo=$this->input->post('test_info');
			if($testinfo == 0)
			{
				$eng_test_info=$this->test_model->get_test_content($testid,'en');
				/*echo "<pre>";
				print_r($eng_test_info);*/
				
				$test_info['testid']=$testid;
				$test_info['lang_code']=$lang_code;
				
				$test_info['post_type']=$eng_test_info->post_type;
				$test_info['category_id']=$eng_test_info->category_id;
				$test_info['created_by']=$this->session->userdata('user_id');
				$test_info['alias']=$eng_test_info->alias;
				$test_info['start_point']=$eng_test_info->start_point;
				$test_info['question']=$eng_test_info->question;
				$test_info['answer']=$eng_test_info->answer;
				$test_info['fun']=$eng_test_info->fun;
				$test_info['enjoy_and_share']=$eng_test_info->enjoy_and_share;
				$test_info['flags']=$eng_test_info->flags;
				$test_info['direct_start']=$eng_test_info->direct_start;
				$test_info['is_real_test']=$eng_test_info->is_real_test;
				$test_info['status']=2;
				$test_info['created']=date("Y-m-d");
				//$test_info['activated_date']=$eng_test_info->activated_date;
				$test_info['modify_date']==date("Y-m-d");
				$test_info['image']=$eng_test_info->image;
				$test_info['image_thumb']=$eng_test_info->image_thumb;
				$test_info['popup_box_text']=$eng_test_info->popup_box_text;
				
				
				
				$id=$this->test_model->save_test_content($test_info);
				$this->test_model->remove_checking($testid,$lang_code);
				//-------- meta insert -----
				$meta_info['test_id']=$id;
				$meta_info['meta_key']='sub_title';
				$meta_info['meta_value']=$this->input->post('sub_title');
				$this->test_model->add_meta($meta_info);
				
				
				$meta_info=array();
				$meta_info['meta_value']=$this->input->post('button_text');
				$meta_info['test_id']=$id;
				$meta_info['meta_key']="button_text";
				$this->test_model->edit_testMeta($meta_info,$id,'button_text');
				
				
				
			}			
			else
			{
				$tests_Id=$this->input->post('tests_Id');
				if($this->input->post('sub_title'))
				{
					
					$meta_info['meta_value']=$this->input->post('sub_title');					
					$this->test_model->edit_testMeta($meta_info,$tests_Id,'sub_title');
				}
				$this->test_model->update_test_content($test_info,$testid,$lang_code);
				
				$meta_info=array();
				$meta_info['meta_value']=$this->input->post('button_text');
				$meta_info['test_id']=$tests_Id;
				$meta_info['meta_key']="button_text";
				$this->test_model->edit_testMeta($meta_info,$tests_Id,'button_text');
			}
			
			$this->session->set_flashdata('success_message',' Test has been saved');
			redirect('admin/test_manager/add_question_wizard/'.$testid."/".$lang_code);
		
		}
		else
		{
			$data['test_info']=$this->test_model->get_test_content($testid,$lang_code);
			// for old image
			if(!$data['test_info'])
			{
				$has_checked=$this->test_model->has_checked($testid,$lang_code);
				if(!$has_checked && $this->session->userdata('user_type') == 3)
				{
					$check_info['testid']=$testid;
					$check_info['lang_code']=$lang_code;
					$check_info['user_id']=$this->session->userdata('user_id');
					$check_info['lang_code']=$lang_code;
					$check_info['created']=date('Y-m-d');
					$this->test_model->add_checkings($check_info);
				}
				else if($has_checked && $has_checked->user_id != $this->session->userdata('user_id'))
				{
					$this->session->set_flashdata('error_message',"This test already assigned to other user.");
					redirect('admin/tests');
					exit;
				}
				
				
			}
			else if($data['test_info']->created_by != $this->session->userdata('user_id') && $this->session->userdata('user_type') != 1)
			{
				$this->session->set_flashdata('error_message',"This test already assigned to other user.");
				redirect('admin/tests');
				exit;
			}

			$eng_test_info=$this->test_model->get_test_content($testid,'en');
			$data['eng_test_info']=$eng_test_info;
			$data['eng_test_image']=$eng_test_info->image;
			$data['eng_test_image_thumb']=$eng_test_info->image_thumb;
			$data['is_real_test']=$eng_test_info->is_real_test;
			// end for old image

			$data['eng_test_alias']=$eng_test_info->alias;
			$data['flags']=$this->test_model->get_flags();
			$data['testid']=$testid;
			$data['lang_code']=$lang_code;
			

			$data['referance']='';
			$data['content']=$this->load->view('admin/test_manager/edit',$data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');	
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Content','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Content Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	
	
	
	
	function add_question_wizard($testid,$lang='en',$questionid='0',$question_num=1)
	{ 

		if($this->input->post('add_question'))
		{
			if($this->input->post('test_question_id') > 0)
			{
				$questioninfo['question']=$this->input->post('question');
				$this->test_model->question_edit($questioninfo,$this->input->post('test_question_id'));
				//echo $this->db->last_query();
				$question_info=$this->test_model->get_question_by_pk_id($this->input->post('test_question_id'));
				
				//print_r($this->input->post('test_question_id')); exit;
			}
			else
			{
				
				$question_info['question']=$this->input->post('question');
				$question_info['test_id']=$testid;
				$question_info['test_questionid']=$this->input->post('test_questionid');
				$question_info['lang_code']=$lang;
				$question_info['status']=1;
				$question_info['image']=$this->input->post('image');
				$question_id=$this->test_model->add_question($question_info);
				$question_info=$this->test_model->get_question_by_pk_id($question_id);
				
				
				//-----------------
				//$update_ques_info['test_questionid']=$question_id;
				//$this->test_model->question_edit($update_ques_info,$question_id);
				// --------------
			}
			//echo $questionid; exit;
			$this->session->set_flashdata('success_message','Question has been saved');
			redirect('admin/test_manager/add_answer_wizard/'.$testid.'/'.$question_info->test_questionid.'/'.$lang."/".$question_num);
			//redirect('admin/test_manager/add_question_wizard/'.$testid.'/'.$lang.'/'.$questionid."/".$question_num);

		}

		else

		{
			$db_data['testid']	=$testid;	
			$db_data['question_num']	=$question_num;
			$db_data['lang']	=$lang;	
			$db_data['questionid']	=$questionid;	
			
			$default_question=$this->test_model->default_question($testid,$questionid,'en',$question_num,1);
			if(!$default_question)
			{
				redirect('admin/test_manager/add_wizard_result_option/'.$testid."/".$lang);
			}
			//echo $this->db->last_query();
			$question_info=$this->test_model->get_question($default_question->test_questionid,$lang);
			
			$db_data['default_question']=$default_question;	
			$db_data['question_info']=$question_info;
			
			$test_info=$this->test_model->get_test_content($testid,$lang);
			$default_test_info=$this->test_model->get_test($testid,'en');
			$db_data['test_info']=$test_info;
			$db_data['default_test_info']=$default_test_info;
			
			$data['content']=$this->load->view('admin/test_manager/question_add_wizard_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/test_manager/edit/'.$testid."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$testid."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Question Add Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);

		}

	}
	
	
	function add_answer_wizard($testid,$test_questionid,$lang,$question_num)
	{
		if($this->input->post('add_answer'))
		{
			
			/*$answers_info_1['answere']=$this->input->post('answere1');
			$answers_info_1['test_question_id']=$test_questionid;
			$answers_info_1['lang_code']=$lang;
			$answers_info_1['marks']=$this->input->post('marks1');
			$answers_info_1['answereid']=$this->input->post('answereid1');
			$answers_info_1['status']=1;
			
			$answers_info_2['answere']=$this->input->post('answere2');
			$answers_info_2['test_question_id']=$test_questionid;
			$answers_info_2['answereid']=$this->input->post('answereid2');
			$answers_info_2['lang_code']=$lang;
			$answers_info_2['marks']=$this->input->post('marks2');
			$answers_info_2['status']=1;
			
			$answers_info_3['answere']=$this->input->post('answere3');
			$answers_info_3['test_question_id']=$test_questionid;
			$answers_info_3['answereid']=$this->input->post('answereid3');
			$answers_info_3['lang_code']=$lang;
			$answers_info_3['marks']=$this->input->post('marks3');
			$answers_info_3['status']=1;*/
			
			//print_r($answers_info_1); exit;
			if($this->input->post('have_answers') < 1)
			{
				$answers_info_1['answere']=$this->input->post('answere1');
				$answers_info_1['test_question_id']=$test_questionid;
				$answers_info_1['lang_code']=$lang;
				$answers_info_1['marks']=$this->input->post('marks1');
				$answers_info_1['answereid']=$this->input->post('answereid1');
				$answers_info_1['status']=1;
				
				$answers_info_2['answere']=$this->input->post('answere2');
				$answers_info_2['test_question_id']=$test_questionid;
				$answers_info_2['answereid']=$this->input->post('answereid2');
				$answers_info_2['lang_code']=$lang;
				$answers_info_2['marks']=$this->input->post('marks2');
				$answers_info_2['status']=1;
				
				$answers_info_3['answere']=$this->input->post('answere3');
				$answers_info_3['test_question_id']=$test_questionid;
				$answers_info_3['answereid']=$this->input->post('answereid3');
				$answers_info_3['lang_code']=$lang;
				$answers_info_3['marks']=$this->input->post('marks3');
				$answers_info_3['status']=1;
				//$this->test_model->add_batch_answer($answers);
				$insert_answer_id1=$this->test_model->add_answer($answers_info_1);

				$insert_answer_id2=$this->test_model->add_answer($answers_info_2);

				$insert_answer_id3=$this->test_model->add_answer($answers_info_3);

			}
			else
			{
				$answers_info_1['answere']=$this->input->post('answere1');
				$answers_info_2['answere']=$this->input->post('answere2');
				$answers_info_3['answere']=$this->input->post('answere3');
				
				$this->test_model->edit_answer($answers_info_1,$this->input->post('answereid1'),$lang);
				$this->test_model->edit_answer($answers_info_2,$this->input->post('answereid2'),$lang);
				$this->test_model->edit_answer($answers_info_3,$this->input->post('answereid3'),$lang);
				
			}
			$this->session->set_flashdata('success_message','Answer has been saved');

			//redirect('admin/tests/twist_add_question_wizard/'.$test_id."/".($question_num+1));
			redirect('admin/test_manager/add_question_wizard/'.$testid."/".$lang."/".$test_questionid."/".($question_num+1)); 
			
			//redirect('admin/tests/add_question_wizard/'.$test_id."/".$question_num+1);
		}

		else
		{
			$question_info=$this->test_model->get_question($test_questionid,$lang);
			$answers=$this->test_model->get_answers($test_questionid,$lang);
			$default_answers=$this->test_model->get_answers($test_questionid,'en');
			
			$db_data['question_info']	=$question_info;
			$db_data['answers']	=$answers;
			$db_data['default_answers']	=$default_answers;
			
			$db_data['test_question_id']	=$test_questionid;	
			$db_data['question_num']=$question_num;
			$db_data['test_id']=$testid;
			$db_data['lang']=$lang;
			
			$data['content']=$this->load->view('admin/test_manager/add_answer_wizard',$db_data,true);
			
			
			$test_info=$this->test_model->get_test($question_info->test_id);
			//------- end breadcrumbs
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/test_manager/edit/'.$test_info->testid."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang);    
			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/test_manager/add_question_wizard/'.$test_info->testid."/".$lang."/".$test_questionid."/".$question_num);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_questionid."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	
	
	
	function add_wizard_result_option($testid,$lang,$result_num=1)
	{
		if($this->input->post('add_result_option'))
		{
			
			if($this->input->post('result_info') == 0)
			{

				$result_options['result']=$this->input->post('result');
				$result_options['result_description']=$this->input->post('result_description');
				$result_options['test_id']=$this->input->post('test_id');
				$result_options['lang_code']=$lang;
				
				$result_options['result_optionid']=$this->input->post('result_optionid');
				$result_options['interval_from']=$this->input->post('interval_from');
				$result_options['interval_to']=$this->input->post('interval_to');
				$result_options['test_result_img']=$this->input->post('test_result_img');
				$result_options['font_name']=$this->input->post('font_name');
				$result_options['font_color']=$this->input->post('font_color');
				/*echo "<pre>";
				print_r($result_options); exit;*/
				$result_inseret_id=$this->test_model->add_result_option($result_options);
			}
			else
			{
				$result_options['result']=$this->input->post('result');
				$result_options['result_description']=$this->input->post('result_description');
				
				$this->test_model->update_result_option($result_options,$this->input->post('result_optionid'),$lang);
			}

			
			/*$update_result_options['result_optionid']=$result_inseret_id;
			$this->test_model->update_wizard_result($update_result_options,$result_inseret_id);*/

			$this->session->set_flashdata('success_message','Result option has been saved');

			redirect('admin/test_manager/add_wizard_result_option/'.$testid."/".$lang."/".($result_num + 1));

		}

		else

		{

			$data['test_info']=$this->test_model->get_test($testid,$lang);
			$default_result=$this->test_model->default_result($testid,'en',$result_num,1);
			/*echo "<pre>";
			print_r($default_result);*/
			if(!$default_result)
			{
				redirect('admin/tests');
			}
			
			$result_info=$this->test_model->get_result_option($default_result->result_optionid,$lang);
			$data['result_info']=$result_info;
			$data['test_id']=$testid;
			$data['result_num']=$result_num;
			$data['default_result']=$default_result;
			$data['lang']=$lang;
			
			$data['content']=$this->load->view('admin/test_manager/add_wizard_result_option',$data,true);
			$data['page_header']="Result Option : ".$data['test_info']->title;
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/test_manager/edit/'.$testid."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->tests_id."/".$lang);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);

		}

	}

	

	
	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */