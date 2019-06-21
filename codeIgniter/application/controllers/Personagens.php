<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personagens extends CI_Controller
{
    public function __construct()
    {
        //Chama modelo para carregar dados
        parent::__construct();
        $this->load->model('Personagens_model');
        $this->load->model('Inimigos_model');
        $this->load->model('Jogadores_model');
    }
    public function index()
    {
        $data['personagens'] = $this->Personagens_model->selecionar_todos();
        $data['inimigos'] = $this->Inimigos_model->selecionar_todos();
        $data['jogadores'] = $this->Jogadores_model->selecionar_todos();
        //Chama a view pra carregar html
        $this->load->view('bootstrap');
        $this->load->view('cabecalho/inicio');
        $this->load->view('cabecalho/personagens');
        $this->load->view('Personagens_index', $data);
    }

    public function cadastrar()
    {
        if ($_POST) {
            $this->Personagens_model->inserir($_POST);
            redirect('/Personagens');
        } else {
            $this->load->view('bootstrap');
            $this->load->view('cabecalho/inicio');
            $this->load->view('cabecalho/personagens');
            $this->load->view('Personagens_cadastrar');
        }

        /*
        Carregar view inicial ou sla!
        */
    }

    public function atualizar($id)
    {
        if ($_POST) {
            $this->Personagens_model->alterar($id, $_POST);
            $data['personagem'] = $this->Personagens_model->selecionar_todos();
            redirect('/Personagens');
        } else {
            $data['personagem'] = $this->Personagens_model->selecionar($id);
            $this->load->view('bootstrap');
            $this->load->view('cabecalho/inicio');
            $this->load->view('cabecalho/personagens');
            $this->load->view('Personagens_atualizar', $data);
        }


        /*
        Carregar alguma view mostrando que alterou!
        */
    }

    public function deletar($id)
    {


        $this->Personagens_model->remover($id);
        $data['personagens'] = $this->Personagens_model->selecionar_todos();

        $this->index();
        /*
        ou
        
        Carregar alguma view
        */
        redirect('/Personagens');
    }
}
