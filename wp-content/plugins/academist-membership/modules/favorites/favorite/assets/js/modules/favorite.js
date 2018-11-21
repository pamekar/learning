(function($) {
    'use strict';

    var membershipFavorites = {};
    eltdf.modules.membershipFavorites = membershipFavorites;

    membershipFavorites.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfMembershipAddToWishlist();
        eltdfMembershipAddToWishlistTriggerEvent();
    }

    function eltdfMembershipAddToWishlist(){
        $('.eltdf-membership-item-favorites').on('click',function(e) {
            e.preventDefault();
            var item = $(this),
                itemID;

            if(typeof item.data('item-id') !== 'undefined') {
                itemID = item.data('item-id');
            }

            eltdfMembershipWhishlistAdding(item, itemID);
        });
    }

    function eltdfMembershipWhishlistAdding(item, itemID){
        var ajaxData = {
            action: 'academist_membership_add_item_to_favorites',
            item_id : itemID
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: eltdfGlobalVars.vars.eltdfAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                
                if(response.status === 'success'){
                    if(!item.hasClass('eltdf-icon-only')) {
                        item.find('span').text(response.data.message);
                    }
                    item.find('.eltdf-favorites-icon').removeClass('eltdf-favorite-inactive eltdf-favorite-active').addClass(response.data.icon);
                }
            }
        });

        return false;
    }

    function eltdfMembershipAddToWishlistTriggerEvent() {
        $( document.body ).on( 'academist_membership_favorites_trigger', function() {
            eltdfMembershipAddToWishlist();
        });
    }

})(jQuery);