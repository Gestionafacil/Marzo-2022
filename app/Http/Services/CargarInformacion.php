<?php

    namespace GestionaFacil\Http\Services;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;

    class cargarInformacion{

        protected Request $request;

        public function __construct( Request $request ){
            $this->request = $request;
        }

        public function cargar():Request{
            $this->emisor();
            $this->receptor();
            $this->comprobante();
            return $this->request;
        }

        private function emisor(): void{
            $this->request["emisor"] = $this->request->user()->persona->empresa;
        }

        private function receptor(): void{
            $this->request["receptor"] = DB::table('contactoview')->where('id', $this->request->contacto_id)->first();
        }

        private function comprobante(): void{
            $this->request["empresa"] = $this->request->user()->persona->empresa;
        }

    }