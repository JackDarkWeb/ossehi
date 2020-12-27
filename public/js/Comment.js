import Helpers from "./Helpers.js";

export default class Comment {

    static $doc = $(document);
    static $canReload;
    /**
     * Open form comment
     * @param idContainerOpen
     * @param idBtnOpen
     */
    static openForm(idContainerOpen, idBtnOpen){

        if($(idContainerOpen).is(':visible')) return;

        $(idContainerOpen).slideDown();

        $(idBtnOpen).fadeIn();
    }

    /**
     * Close form comment
     * @param idContainerOpen
     * @param idBtnClose
     */
    static closeForm(idContainerOpen, idBtnClose){

        if(!$(idContainerOpen).is(':visible')) return;

        $(idContainerOpen).slideUp();

        $(idBtnClose).fadeOut();
    }

    /**
     *
     * @param idForm
     * @param idReplyBtn
     * @param idTextarea
     * @param idBtnOpenForm
     */
    static replyComment(idForm, idReplyBtn, idTextarea, idBtnOpenForm){

        Comment.$doc.on('click', idReplyBtn, function(event){

            event.preventDefault();

            const replyName = $(this).data('name');

            Comment.openForm(idForm, idBtnOpenForm);

            Helpers.setValue(idForm, idTextarea, `@${replyName} `);

            $(idForm).find(idTextarea).focus();

        });
    }

    /**
     *
     * @param idBtnEvent
     * @param canReload
     * @param func_fetch_comments
     */
    static reloadComments(idBtnEvent, canReload, func_fetch_comments){

        Comment.$canReload = canReload;

        Comment.$doc.on('click', idBtnEvent, function (event)
        {
            event.preventDefault();

            if(!Comment.$canReload) return false;

            func_fetch_comments();

            Comment.$canReload = false;

            // Allow additional reloads after 2 seconds
            setTimeout(function(){
                Comment.$canReload = true;
            }, 2000);
        });
    }
}
