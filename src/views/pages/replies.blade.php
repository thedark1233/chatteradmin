@extends('chatter::admin')
@section('page')
    <div class="chatter-admin-{{ $page }}">
        <ul class="items-list">
            <li class="items-head">
                <div class="list-inner">
                    <div class="pure-g">
                        <div class="cell hand--1-2 nexus--1-5"><p>Discussion</p></div><!--
            --><div class="cell hand--1-2 nexus--1-5"><p>Titre</p></div><!--
            --><div class="cell hand--1-2 nexus--1-5"><p>Utilisateur</p></div><!--
            --><div class="cell hand--1-2 nexus--1-5"><p>Message</p></div><!--
            --><div class="cell hand--1-2 nexus--1-5"><p>Ajouté le</p></div>
                    </div>
                </div>
            </li>
            @foreach($replications as $key => $reply)
                <li class="items-unique item-user-{{ $key +1  }}">
                    <div class="list-inner">
                        <div class="pure-g">
                            <div class="cell hand--1-2 nexus--1-5"><p>{{ ucwords($reply->discussion->title) }}</p></div><!--
          --><div class="cell hand--1-2 nexus--1-5"><p>{{ $reply->discussion->title }}</p></div><!--
          --><div class="cell hand--1-2 nexus--1-5"><p>{{ $reply->user->name }} - {{$discussion->user->email}} </p></div>
            <div class="cell hand--1-2 nexus--1-5"><p>{!! $reply->body !!}</p></div><!--
            --><div class="cell hand--1-2 nexus--1-5"><p>{{ $reply->created_at }}</p></div>
                        </div>
                        <div class="update-item-actions hidden">
                            <button class="edit" type="button" name="button">Edit</button><button class="delete" type="button" name="button" disabled>Delete</button>
                        </div>
                    </div>
                </li>
            @endforeach
            {{ $replications->links() }}
        </ul>

    </div>
@endsection
