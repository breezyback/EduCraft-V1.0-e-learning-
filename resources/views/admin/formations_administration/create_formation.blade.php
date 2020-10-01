@extends('layouts.hello')

@section('content')

    <div class="container-fluid">
        <div class="row mb-5 mt-5 p-4">
            <div class="col m-5">
                <img src="{{ asset('img/admin/categories_administration/add1.svg') }}" alt="" style="width: 50vw;">
            </div>

            <form class="col-auto pt-5 pb-4 pl-4 pr-4 position-absolute" action="" method="POST" style="background-color: rgb(151, 151, 219, 0.5); left: 45vw; backdrop-filter: blur(10px); border-radius: 15px;">
                @csrf
                <div class="row">
                    <div class="col text-center">
                        <h1 style="font: ; color: #FF6584;">Create</h1>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col text-center">
                        <h1 style="font: 700 3.5vw 'Roboto'; color: #0E153A;">FORMATION</h1>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="cat_title" style="font: 500 1.1vw 'Roboto';">Categorie Title</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="categ_title" id="categ_title">
                                    @foreach ($categories1 as $categ)
                                        <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="form_title" style="font: 500 1.1vw 'Roboto';">Title</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="form_title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="form_descr" style="font: 500 1.1vw 'Roboto';">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea name="form_descr" cols="80" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col mt-2 text-center">
                        <button class="btn btn-lg" type="submit" style="background-color: #0E153A; color: white; border-radius: 20px;">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection