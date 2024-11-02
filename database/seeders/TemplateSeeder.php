<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Section;
use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $template = Template::create([
            'name' => 'Terracota'
        ]);

        $section1 = Section::create([
            'name' => 'portada',
            'body' => '<div class="h-102 bg-image-responsive-1 flex items-end" style="background-image: url(`{{$bg_portada}}`); ">
            <div class="w-full">
                <img src="{{$logo_portada}}" class="h-40 lg:h-56 m-auto mb-12" alt="">
                <p class="font-licorice text-center text-7xl lg:text-7xl text-[#B36A43] mb-10">{{$novios_portada}}</p>
                <div class="text-center w-80 flex m-auto items-center gap-4 text-gray-600 text-2xl">
                    <i id="iconplay" class="fa-solid fa-play" onclick="playSong()"></i>
                    <div class="w-full bg-gray-200 rounded-full h-1">
                        <div id="percentsong" class="bg-gray-600 h-1 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_portada}}',
            'type' => 1,
            'section_id' => $section1->id,
        ]);
        Attribute::create([
            'key' => '{{$logo_portada}}',
            'type' => 1,
            'section_id' => $section1->id,
        ]);
        Attribute::create([
            'key' => '{{$novios_portada}}',
            'type' => 1,
            'section_id' => $section1->id,
        ]);

        $section2 = Section::create([
            'name' => 'Cuenta Atras',
            'body' => '<div class="bg-image-responsive-2 flex items-center" style="background-image: url(`{{$bg_cuenta_atras}}`); ">
            <div class="m-auto flex flex-col text-center gap-5 py-8">
                <span class="font-handlee text-center text-[#B36A43] text-lg">Te invitamos a</span>
                <span class="font-licorice text-center text-6xl text-[#B36A43] mb-5 -mt-2">Nuestra Boda</span>
                <span class="text-gray-800 text-xl lg:text-2xl font-handlee">{{$fecha_cuenta_atras}}</span>
                <span class="text-[#3e301c] text-lg font-handlee">{{$ciudad_cuenta_atras}}</span>
                <div class="bg-[#E9D9C2] h-20 rounded-xl flex py-2 items-center w-11/12 m-auto">
                    <div class="m-auto flex gap-4">
                        <div class="flex flex-col gap-4 font-handlee">
                            <span class="text-lg" id="dayscountdown">00</span>
                            <span class="text-sm">Días</span>
                        </div>
                        <span>:</span>
                        <div class="flex flex-col gap-4 font-handlee">
                            <span class="text-lg" id="hourscountdown">00</span>
                            <span class="text-sm">Horas</span>
                        </div>
                        <span>:</span>
                        <div class="flex flex-col gap-4 font-handlee">
                            <span class="text-lg"  id="minutescountdown">00</span>
                            <span class="text-sm">Min</span>
                        </div>
                        <span>:</span>
                        <div class="flex flex-col gap-4 font-handlee">
                            <span class="text-lg" id="secondscountdown">00</span>
                            <span class="text-sm">Seg</span>
                        </div>
                    </div>
                    
                </div>
                <img src="{{$planta_cuenta_atras}}" class="w-24 lg:w-32 m-auto" style="transform: rotate(30deg);" alt="">
            </div>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_cuenta_atras}}',
            'type' => 1,
            'section_id' => $section2->id,
        ]);

        Attribute::create([
            'key' => '{{$fecha_cuenta_atras}}',
            'type' => 1,
            'section_id' => $section2->id,
        ]);

        Attribute::create([
            'key' => '{{$ciudad_cuenta_atras}}',
            'type' => 1,
            'section_id' => $section2->id,
        ]);

        Attribute::create([
            'key' => '{{$planta_cuenta_atras}}',
            'type' => 1,
            'section_id' => $section2->id,
        ]);

        $section3 = Section::create([
            'name' => 'Mensaje 1',
            'body' => '<div class="bg-[#F4EDDD] flex items-center text-center lg:py-10 py-6 px-10 lg:px-0">
            <span class="m-auto text-gray-600 text-base lg:text-xl lg:w-1/3 leading-loose font-handlee" data-aos="fade-up" data-aos-duration="1000">"{{$text_mensaje_1}}"</span>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$text_mensaje_1}}',
            'type' => 1,
            'section_id' => $section3->id,
        ]);

        $section4 = Section::create([
            'name' => 'Padres novios',
            'body' => '<div class=" bg-image-responsive-3 flex items-center py-4 lg:py-8" style="background-image: url(`{{$bg_padres_novios}}`); ">
            <div class="m-auto flex flex-col text-center" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{$flecha_padres_novios}}" class="w-72 lg:w-96 h-10 m-auto mb-2 lg:mb-10" alt="">
                <span class="font-licorice text-center text-[32px] lg:text-5xl text-[#454545] mb-4 lg:mb-10">{{$texto_1_padres_novios}}</span>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 font-handlee text-[#3e301c]">
                    <div class="flex flex-col text-sm lg:text-lg tracking-wider">
                        <span class="text-xs lg:text-base">{{$texto_2_padres_novios}}</span>
                        <span>{{$texto_3_padres_novios}}</span>
                        <span>{{$texto_4_padres_novios}}</span>
                    </div>
                    <div class="flex flex-col text-sm lg:text-lg tracking-wider">
                        <span class="text-xs lg:text-base">{{$texto_5_padres_novios}}</span>
                        <span>{{$texto_6_padres_novios}}</span>
                        <span>{{$texto_7_padres_novios}}</span>
                    </div>
                </div>
                <img src="{{$flecha_padres_novios}}" class="w-72 lg:w-96 h-10 m-auto mt-4 lg:mt-10" alt="">
            </div>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);

        Attribute::create([
            'key' => '{{$flecha_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_1_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_2_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);
        Attribute::create([
            'key' => '{{$texto_3_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_4_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);
        Attribute::create([
            'key' => '{{$texto_5_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);
        Attribute::create([
            'key' => '{{$texto_6_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);
        Attribute::create([
            'key' => '{{$texto_7_padres_novios}}',
            'type' => 1,
            'section_id' => $section4->id,
        ]);

        $section5 = Section::create([
            'name' => 'horario',
            'body' => '<div class="bg-image-responsive-4 flex flex-col items-center py-4 lg:py-8" style="background-image: url(`{{$bg_horario}}`); ">
            <div class="m-auto grid grid-cols-2 gap-8 lg:gap-48 text-center" data-aos="fade-up" data-aos-duration="1000">
              <div class="flex flex-col">
                <img src="{{$aros_horario}}" class="h-20 lg:h-28 m-auto" alt="">
                <span class="font-licorice text-[40px] lg:text-5xl mt-5 lg:mt-7">{{$texto_1_horario}}</span>
                <span class="font-handlee text-xl lg:text-2xl mt-3 lg:mt-5">{{$texto_2_horario}}</span>
              </div>
              <div class="flex flex-col">
                <img src="{{$copas_horario}}" class="h-20 lg:h-28 m-auto" alt="">
                <span class="font-licorice text-[40px] lg:text-5xl mt-5 lg:mt-7">{{$texto_3_horario}}</span>
                <span class="font-handlee text-xl lg:text-2xl mt-3 lg:mt-5">{{$texto_4_horario}}</span>
              </div>
            </div>
            <div class="flex flex-col text-center mt-8 gap-4" data-aos="fade-up" data-aos-duration="1000">
              <span class="font-handlee text-lg lg:text-2xl">{{$texto_5_horario}}</span>
              <span class="font-handlee text-[14px] lg:text-md">{{$texto_6_horario}}</span>
              <a href="{{$google_maps_horario}}" target="_blank" class="bg-[#E8D7BD] text-[#3e301c] rounded-lg py-3 w-40 text-sm font-semibold m-auto font-handlee">Ver Mapa</a>
            </div>
        
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$aros_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$copas_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_1_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_2_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_3_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_4_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_5_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_6_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        Attribute::create([
            'key' => '{{$google_maps_horario}}',
            'type' => 1,
            'section_id' => $section5->id,
        ]);

        $section6 = Section::create([
            'name' => 'Mesa de regalos',
            'body' => '<div class="bg-image-responsive-5 flex items-center py-8" style="background-image: url(`{{$bg_mesa_regalos}}`); ">
            <div class="m-auto lg:hidden">
              <div class="bg-[#FFFFFE]/80 lg:bg-[#FFFFFE] rounded-xl shadow-lg shadow-black-300 drop-shadow-lg lg:m-auto flex flex-col mx-8 px-6 lg:px-18 2xl:px-24 py-10 lg:w-1/3 text-center gap-6" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{$regalo_mesa_regalos}}" class="h-20 lg:h-28" alt="">
                <span class="font-licorice text-4xl lg:text-5xl">Mesa de Regalos</span>
                <span class="font-handlee text-sm lg:text-[18px]">{{$texto_1_mesa_regalos}}</span>
                <button class="bg-[#E8D7BD] w-40 py-2 rounded-lg font-bold float-right m-auto font-handlee text-sm" onclick="showPanel()">Ver cuentas</button>
              </div>
            </div>
            <div class="hidden bg-[#FFFFFE]/80 lg:bg-[#FFFFFE] rounded-xl shadow-lg shadow-black-300 drop-shadow-lg lg:m-auto lg:flex lg:flex-col mx-8 px-6 lg:px-18 2xl:px-24 py-10 lg:w-1/3 text-center gap-6" data-aos="fade-up" data-aos-duration="1000">
              <img src="{{$regalo_mesa_regalos}}" class="h-20 lg:h-28" alt="">
              <span class="font-licorice text-4xl lg:text-5xl">Mesa de Regalos</span>
              <span class="font-handlee text-sm lg:text-[18px]">{{$texto_1_mesa_regalos}}</span>
              <button class="bg-[#E8D7BD] w-40 py-2 rounded-lg font-bold float-right m-auto font-handlee text-sm" onclick="showPanel()">Ver cuentas</button>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_mesa_regalos}}',
            'type' => 1,
            'section_id' => $section6->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_1_mesa_regalos}}',
            'type' => 1,
            'section_id' => $section6->id,
        ]);


        $section7 = Section::create([
            'name' => 'Vestimenta',
            'body' => '<div class="bg-[#F4EDDD] flex items-center text-center py-10">
            <div class="m-auto flex flex-col px-10 lg:px-0 text-center" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{$vestimenta_vestimenta}}" class="h-20 w-20 m-auto mb-8" alt="">
                <span class="font-licorice text-center text-[40px] lg:text-5xl text-[#555555] mb-2">{{$texto_1_vestimenta}}</span>
                <span class="font-handlee text-sm lg:w-1/3 lg:m-auto lg:text-lg text-[#4d4d4d] mb-4">{{$texto_2_vestimenta}}</span>
                <span class="font-handlee text-xl lg:text-2xl text-[#4d4d4d] mb-2">{{$texto_3_vestimenta}}</span>
                <span class="font-handlee text-base lg:text-lg text-[#4d4d4d]">{{$texto_4_vestimenta}}</span>
            </div>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$vestimenta_vestimenta}}',
            'type' => 1,
            'section_id' => $section7->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_1_vestimenta}}',
            'type' => 1,
            'section_id' => $section7->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_2_vestimenta}}',
            'type' => 1,
            'section_id' => $section7->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_3_vestimenta}}',
            'type' => 1,
            'section_id' => $section7->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_4_vestimenta}}',
            'type' => 1,
            'section_id' => $section7->id,
        ]);

        $section8 = Section::create([
            'name' => 'No niños',
            'body' => '<div class="flex flex-col items-center text-center py-10 px-10 lg:px-0 bg-[#fffdf8]" data-aos="fade-up" data-aos-duration="1000">
            <span class="font-licorice text-center text-5xl text-[#555555] mb-8">{{$texto_1_no_ninos}}</span>
            <span class="font-handlee tracking-wide lg:w-1/3 text-[#4d4d4d] mb-2 text-sm leading-loose lg:text-base">{{$texto_2_no_ninos}}</span>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_1_no_ninos}}',
            'type' => 1,
            'section_id' => $section8->id,
        ]);
        
        Attribute::create([
            'key' => '{{$texto_2_no_ninos}}',
            'type' => 1,
            'section_id' => $section8->id,
        ]);

        $section9 = Section::create([
            'name' => 'Formulario',
            'body' => '<div class="bg-image-responsive-7 flex items-center" style="background-image: url(`{{$bg_formulario}}`); ">
            <div class="m-auto flex flex-col text-center" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{$planta_formulario}}" class="w-20 m-auto mb-5" style="transform: rotate(220deg);" alt="">
                <span class="font-licorice text-center text-5xl text-[#555555] mb-10">Confirma tu Asistencia</span>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mb-2">
                  <div>
                    <input class="font-handlee bg-[#F9F2EC] rounded-lg w-full text-sm h-8 px-4 border-2 border-[#F9E2CE] focus:ring-[#f0cfb4] focus:outline-none focus:border-[#f0cfb4]" type="text" placeholder="Nombre de los asistentes" name="nombre" wire:model="nombre">
                  </div>
                  <div>
                    <input class="font-handlee bg-[#F9F2EC] rounded-lg w-full text-sm h-8 px-4 border-2 border-[#F9E2CE] focus:ring-[#f0cfb4] focus:outline-none focus:border-[#f0cfb4]" type="text" placeholder="Teléfono" name="telefono" wire:model="telefono">
                  </div>
                </div>
                <select class="font-handlee bg-[#F9F2EC] rounded-lg w-full text-sm h-8 px-4 border-2 border-[#F9E2CE] mb-2" id=""  style="font-size: 0.8rem;" name="confirmacion" wire:model="confirmacion">
                  <option value="" disabled selected>Confirmación</option>
                  <option value="Sí">Sí, asistiré.</option>
                  <option value="No">Lo siento, no podré asistir</option>
                </select>
                <textarea name="" id="" rows="5" class="font-handlee bg-[#F9F2EC] p-2 text-sm border-2 border-[#F9E2CE] rounded-lg mb-2 px-4" placeholder="Mensaje para los novios (Opcional)" name="mensaje" wire:model="mensaje"></textarea>
                <div class="w-full">
        
                  <button class="bg-[#E8D7BD] w-40 py-2 rounded-lg font-bold float-right mb-2 font-handlee text-sm" wire:click="addUser">Enviar</button>
                </div>
      
            </div>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$bg_formulario}}',
            'type' => 1,
            'section_id' => $section9->id,
        ]);

        Attribute::create([
            'key' => '{{$planta_formulario}}',
            'type' => 1,
            'section_id' => $section9->id,
        ]);

        $section10 = Section::create([
            'name' => 'Despedida',
            'body' => '<div class="bg-[#F4EDDD] flex flex-col items-center text-center px-10 pt-4">
            <span class="mt-4 font-handlee text-xl text-[#555555] pb-8">{{$texto_despedida}}</span>
          </div>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$texto_despedida}}',
            'type' => 1,
            'section_id' => $section10->id,
        ]);

        $section11 = Section::create([
            'name' => 'Script',
            'body' => '<script>
            var paused = true
            var songFile = "{{$song}}"
            var audio = new Audio()
            var percent = 0
            var countDownDate = new Date("{{$date_script}}").getTime();
            
            window.addEventListener("load", function() {
                this.audio.src = this.songFile;
            
            })
            
            this.audio.addEventListener("timeupdate", (currentTime)=>{
                    this.percent =  (this.audio.currentTime * 100) / {{$songTime}};
            document.getElementById("percentsong").style.width= this.percent+"%";
            
                  });
            
            setInterval(function(){
                    var now = new Date().getTime();
            
              var distance = countDownDate - now;
            
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById("dayscountdown").innerText = days + "";
            document.getElementById("hourscountdown").innerText = hours + "";
            document.getElementById("minutescountdown").innerText =  minutes + "";
            document.getElementById("secondscountdown").innerText = seconds + "";
            
                  },1000);
            
            function showPanel(){
            Swal.fire({
                  html: `
                    <div class="flex flex-col">
                    <span class="font-bold">{{$banco_1_script}}</span>
                    <span>Cta: {{$cta_banco_1_script}}</span>
                    <span>CCI: {{$cci_banco_1_script}}</span>
                    <span>{{$nombre_cta_banco_1_script}}</span>
                    <span class="mt-3 font-bold">{{$banco_2_script}}</span>
                    <span>Cta: {{$cta_banco_2_script}}</span>
                    <span>CCI: {{$cci_banco_2_script}}</span>
                    <span>{{$nombre_cta_banco_2_script}}</span>
                    <span class="mt-3 font-bold">{{$metodo_1_script}}</span>
                    <span>{{$nro_metodo_1_script}}</span>
                    <span>{{$nombre_metodo_1_script}}</span>
                  </div>
                  `,
                  showCloseButton: true,
                  showCancelButton: false,
                  showConfirmButton: false,
                  focusConfirm: false,
                });
            }
            function playSong(){
                if(this.paused){
                  this.audio.play()
                  this.paused = false;
            document.getElementById("iconplay").className = "fa-solid fa-pause";
                }else{
                  this.audio.pause()
                  this.paused = true;
            document.getElementById("iconplay").className = "fa-solid fa-play";
                }
                
              }
            
            </script>',
            'template_id' => $template->id,
        ]);

        Attribute::create([
            'key' => '{{$song}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$songTime}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$date_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);


        Attribute::create([
            'key' => '{{$banco_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$cta_banco_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$cci_banco_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$nombre_cta_banco_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$banco_2_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$cta_banco_2_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$cci_banco_2_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$nombre_cta_banco_2_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$metodo_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$nro_metodo_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);

        Attribute::create([
            'key' => '{{$nombre_metodo_1_script}}',
            'type' => 1,
            'section_id' => $section11->id,
        ]);


    }
}
