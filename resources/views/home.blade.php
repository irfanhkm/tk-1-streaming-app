<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoTube</title>
    @if(env('APP_ENV') == 'production')
        <link href="https://cdn.statically.io/gh/irfanhkm/tk-1-streaming-app/fae1da95/public/css/app.css" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.8.3.min.js'></script>
</head>
<body>
<header class="fixed w-full">
    <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
            <a href="#" class="flex items-center">
                <img
                    src="https://image.winudf.com/v2/image1/Y29tLnNhc29mdC5wbGF5LnR1YmUudmlkZW90dWJlLm11c2ljdHViZV9pY29uXzE1NTQ4NzE0NjRfMDg5/icon.png?w=&fakeurl=1"
                    class="h-10 mr-3 lg:h-20"
                    alt="Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">VideoTube</span>
            </a>
            <div class="flex items-center lg:order-2">
                <div class="hidden mt-2 mr-4 sm:inline-block">
                    <span></span>
                </div>

                <button
                    class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800"
                    type="button"
                    id="buttonUploadVideo"
                >
                    Upload Video
                </button>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </nav>
</header>
<!-- Start block -->
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-28">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h2 class="uppercase tracking-wider text-lg font-semibold">Uploaded Videos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($videos as $video)
                    <div class="mt-5 cursor-pointer" id="thumbnail-{{$video->id}}">
                        <img src="{{$video->thumbnail}}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray-300">{{$video->name}}</a>
                        </div>
                    </div>

                    <div class="fixed z-10 hidden"
                         aria-labelledby="modal-detail-{{$video->id}}"
                         role="dialog"
                         aria-modal="true"
                         id="modal-detail-{{$video->id}}">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="fixed inset-0 z-10 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <div class="bg-white pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <video controls>
                                                <source src="{{$video->url}}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                    <form class=6" action="{{route('upload.video.update', $video->id)}}" method="post" enctype="multipart/form-data">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900 font-bold" id="modal-title">Edit Video</h3>
                                                @csrf
                                                @method('PUT')
                                                <div class="mt-3">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Video</label>
                                                    <input type="text"
                                                           name="name"
                                                           id="name"
                                                           value="{{$video->name}}"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                           placeholder="Video lucu" required>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Video</label>
                                                    <input type="file"
                                                           name="video"
                                                           id="video"
                                                           accept="video/mp4,video/x-m4v,video/*"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                            <button type="submit"
                                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Edit</button>
                                            <div class="cursor-pointer mt-3 inline-flex w-full justify-center
                                                        rounded-md border border-gray-300 bg-white px-4 py-2 text-base
                                                        font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none
                                                        focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3
                                                        sm:w-auto sm:text-sm"
                                                 id="deleteData-{{$video->id}}"
                                                 aria-label="{{route('upload.video.delete', $video->id)}}"
                                            >
                                                Delete
                                            </div>
                                            <div class="cursor-pointer mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                 id="closeModal-{{$video->id}}">
                                                Cancel
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="relative z-10 hidden" aria-labelledby="modal-form" role="dialog" aria-modal="true" id="modal-form">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form class=6" action="{{route('upload.video.create')}}" method="post" enctype="multipart/form-data">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 font-bold" id="modal-title">Upload Video</h3>
                            @csrf
                            <div class="mt-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Video</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       placeholder="Video lucu" required>
                            </div>
                            <div class="mt-3">
                                <label for="video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Video</label>
                                <input type="file"
                                       name="video"
                                       id="video"
                                       accept="video/mp4,video/x-m4v,video/*"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="submit"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Upload</button>
                        <button type="button"
                                id="closeButtonForm"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End block -->
</body>
</html>

<script>
    const modalForm = document.getElementById("modal-form");

    document.getElementById("buttonUploadVideo").onclick = function() {
        modalForm.classList.remove("hidden");
    }

    document.getElementById("closeButtonForm").onclick = function () {
        modalForm.classList.add("hidden");
    }

    $(document).find("div[id^='thumbnail-']").live('click', function(){
        const num = this.id.split('-')[1];
        $('#modal-detail-' + num).toggle();
    });

    $(document).find("div[id^='closeModal-']").live('click', function() {
        const num = this.id.split('-')[1];
        $('#modal-detail-' + num).toggle();
    });

    $(document).find("div[id^='deleteData-']").live('click', function() {
        const num = this.id.split('-')[1];
        if (confirm("Are you sure want to delete this data ?")) {
            $.ajax({
                url: this.ariaLabel,
                type: 'DELETE',
                success: function() {
                    location.reload();
                    $('#modal-detail-' + num).toggle();
                }
            });
        }
    });
</script>
