@extends('layouts.app')
@section('estilos')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border-left-color: #09f;
            margin: auto auto;
            animation: spin 1s ease infinite;
        }
        @keyframes spin {
            0% {
              transform: rotate(0deg);
            }
          
            100% {
              transform: rotate(360deg);
            }
          }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <video style="width: 95%" id="preview"></video>
            <span>Escanee el codigo QR</span>
        </div>
        <div class='spinner d-none'></div>
        <div class="col-sm-12 col-md-6 p-5 " id="infoBox">
            

        </div>
    </div>
@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/instascan.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        const args = {
            video: document.getElementById('preview')
        };
        let user=null;
        let attendance_id='{{ $attendance->id }}';
        const box=document.getElementById('infoBox');
        const spinner=document.querySelector('.spinner');
        let scanner = new Instascan.Scanner(args);

        window.URL.createObjectURL = (stream) => {
            args.video.srcObject = stream;
            return stream;
        };
        
        scanner.addListener('scan', async function(content) {
            spinner.classList.remove('d-none');
            const resp = await fetch(`info-user/${content}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            });
            const data = await resp.json();
            spinner.classList.add('d-none');
            box.innerHTML=''
            box.innerHTML=`
                <h3 class="pb-1 text-primary">${data.name}</h3>
                <p>DNI: ${data.dni}</p>
                <span>${data.grado}</span> - <span>${data.seccion}</span>
                <p>Turno: ${data.turno == 'T' ? 'Tarde' : 'Mañana'}</p>
                <button class="btn btn-primary btnRegistrar">Registrar Asistencia</button>
            `
            user=data;
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[1] ? cameras[1] : cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        box.addEventListener('click',async(e)=>{
            if(e.target.classList.contains('btnRegistrar')){
                //sweet alert para confirmar
                Swal.fire({
                    title: '¿Esta seguro?',
                    text: "¿Desea registrar la asistencia de este alumno?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, registrar!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const resp = await fetch(`registrar-asistencia/${user.id}/${attendance_id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        });
                        const data = await resp.json();
                        Swal.fire(data.message, '', data.type)
                    }
                })

                
            }
         });
    </script>
@endsection
