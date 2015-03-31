<?php

/**
 * Posts Controller Class
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @package    app.Controller 
 * @author John Doe <john.doe@example.com>
 */
class PostsController extends AppController
{
    public $helpers = array('Html', 'Form');
    
    /*
     * Method to display all posts
     * 
     * @params mixed
     * 
     */
    
    public function index()
    {
        $this->set('posts', $this->Post->find('all'));
    }
    
    
    
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        
        $post   =   $this->Post->findById($id);
        
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        
        $this->set('post', $post);
    }
    
    
    public function add($id = null)
    {
        $post = $this->Post->findById($id);
        
        if ($post) {
                $this->Post->id = $id;
        }
        
        if ($this->request->is(array('post','put'))) {
                 
            $this->Post->create();
            
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            
            
            $this->Session->setFlash(__('Unable to add your post.'));
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
     
     
    public function delete($id)
    {
        if ($this->request->is('get')) {
            throw new Exception;
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__("Your post is deleted successfully"));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
