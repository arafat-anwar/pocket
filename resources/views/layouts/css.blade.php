<style type="text/css" media="screen">
    .container {
        margin-top: 20px;
    }

    body{
        background:#eee   
    }

    .half-a-second{
        display: none
    }
    
    .email-app {
        display: flex;
        flex-direction: row;
        background: #fff;
        border: 1px solid #e1e6ef;
    }

    .email-app nav {
        flex: 0 0 200px;
        padding: 1rem;
        border-right: 1px solid #e1e6ef;
    }

    .email-app nav .btn-block {
        margin-bottom: 15px;
    }

    .email-app nav .nav {
        flex-direction: column;
    }

    .email-app nav .nav .nav-item {
        position: relative;
    }

    .email-app nav .nav .nav-item .nav-link,
    .email-app nav .nav .nav-item .navbar .dropdown-toggle,
    .navbar .email-app nav .nav .nav-item .dropdown-toggle {
        color: #151b1e;
        border-bottom: 1px solid #e1e6ef;
    }

    .email-app nav .nav .nav-item .nav-link i,
    .email-app nav .nav .nav-item .navbar .dropdown-toggle i,
    .navbar .email-app nav .nav .nav-item .dropdown-toggle i {
        width: 20px;
        margin: 0 10px 0 0;
        font-size: 14px;
        text-align: center;
    }

    .email-app nav .nav .nav-item .nav-link .badge,
    .email-app nav .nav .nav-item .navbar .dropdown-toggle .badge,
    .navbar .email-app nav .nav .nav-item .dropdown-toggle .badge {
        float: right;
        margin-top: 4px;
        margin-left: 10px;
    }

    .email-app main {
        min-width: 0;
        flex: 1;
        padding: 1rem;
    }

    .email-app .inbox .toolbar {
        padding-bottom: 1rem;
        border-bottom: 1px solid #e1e6ef;
    }

    .email-app .inbox .messages {
        padding: 0;
        list-style: none;
    }

    .email-app .inbox .message {
        position: relative;
        padding: 1rem 1rem 1rem 2rem;
        cursor: pointer;
        border-bottom: 1px solid #e1e6ef;
    }

    .email-app .inbox .message:hover {
        background: #f9f9fa;
    }

    .email-app .inbox .message .actions {
        position: absolute;
        left: 0;
        display: flex;
        flex-direction: column;
    }

    .email-app .inbox .message .actions .action {
        width: 2rem;
        margin-bottom: 0.5rem;
        color: #c0cadd;
        text-align: center;
    }

    .email-app .inbox .message a {
        color: #000;
    }

    .email-app .inbox .message a:hover {
        text-decoration: none;
    }

    .email-app .inbox .message.unread .header,
    .email-app .inbox .message.unread .title {
        font-weight: bold;
    }

    .email-app .inbox .message .header {
        display: flex;
        flex-direction: row;
        margin-bottom: 0.5rem;
    }

    .email-app .inbox .message .header .date {
        margin-left: auto;
    }

    .email-app .inbox .message .title {
        margin-bottom: 0.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .email-app .inbox .message .description {
        font-size: 12px;
    }

    .email-app .message .toolbar {
        padding-bottom: 1rem;
        border-bottom: 1px solid #e1e6ef;
    }

    .email-app .message .details .title {
        padding: 1rem 0;
        font-weight: bold;
    }

    .email-app .message .details .header {
        display: flex;
        padding: 1rem 0;
        margin: 1rem 0;
        border-top: 1px solid #e1e6ef;
        border-bottom: 1px solid #e1e6ef;
    }

    .email-app .message .details .header .avatar {
        width: 40px;
        height: 40px;
        margin-right: 1rem;
    }

    .email-app .message .details .header .from {
        font-size: 12px;
        color: #9faecb;
        align-self: center;
    }

    .email-app .message .details .header .from span {
        display: block;
        font-weight: bold;
    }

    .email-app .message .details .header .date {
        margin-left: auto;
    }

    .email-app .message .details .attachments {
        padding: 1rem 0;
        margin-bottom: 1rem;
        border-top: 3px solid #f9f9fa;
        border-bottom: 3px solid #f9f9fa;
    }

    .email-app .message .details .attachments .attachment {
        display: flex;
        margin: 0.5rem 0;
        font-size: 12px;
        align-self: center;
    }

    .email-app .message .details .attachments .attachment .badge {
        margin: 0 0.5rem;
        line-height: inherit;
    }

    .email-app .message .details .attachments .attachment .menu {
        margin-left: auto;
    }

    .email-app .message .details .attachments .attachment .menu a {
        padding: 0 0.5rem;
        font-size: 14px;
        color: #e1e6ef;
    }

    @media (max-width: 767px) {
        .email-app {
            flex-direction: column;
        }
        .email-app nav {
            flex: 0 0 100%;
        }
    }

    @media (max-width: 575px) {
        .email-app .message .header {
            flex-flow: row wrap;
        }
        .email-app .message .header .date {
            flex: 0 0 100%;
        }
    }


    table tr td{
        vertical-align: middle !important;
    }

    .dataTables_filter{
        margin-top: -30px
    }

    .card-header h4{
        margin-bottom:  0px !important;
    }

    .fc-button{
        text-transform: capitalize !important;
    }
</style>
@include('yajra.css')