// import * as $ from 'jquery';
// import swal from 'sweetalert2';

// export default (function () {
//     $(document).on('click', "form.delete button, form.delete .btn", function(e) {
//         var _this = $(this);
//         e.preventDefault();
//         swal.fire({
//             title: 'Bent u zeker?', // Opération Dangereuse
//             text: 'Bent u zeker dat u wilt doorgaan met deze handeling? Deze handeling kan niet ongedaan worden gemaakt.', // Êtes-vous sûr de continuer ?
//             type: 'error',
//             showCancelButton: true,
//             confirmButtonColor: 'null',
//             cancelButtonColor: 'null',
//             confirmButtonClass: 'btn btn-primary-gradient',
//             cancelButtonClass: 'btn btn-primary',
//             confirmButtonText: 'Doorgaan!', // Oui, sûr
//             cancelButtonText: 'Annuleren', // Annuler
//         }).then(res => {
//             if (res.value) {
//                 _this.closest("form").submit();
//             }
//         });
//     });
// }())
