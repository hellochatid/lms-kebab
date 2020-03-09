<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Navbar, Sidebar } from "~/components/admin/";

export default {
  // middleware: "admin",
  components: {
    Navbar,
    Sidebar
  },
  head() {
    return {
      link: [
        {
          rel: "stylesheet",
          href:
            "https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap"
        }
      ]
    };
  }
};
</script>

<style>
/*------------------------------------------*/
/*	    Buttons
/*------------------------------------------*/
.btn {
  font-size: 0.875rem;
  font-weight: 600;
  padding: 11px 36px;
}
.btn:after {
  content: " ";
  display: table;
  clear: both;
}
[type="button"]:focus,
a:active,
a:focus,
a:visited,
button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner,
select::-moz-focus-inner,
.btn {
  outline: 0 !important;
  box-shadow: 0 0 0 rgba(255, 255, 255, 0) !important;
}
.btn.btn-action .icon {
  float: left;
  margin-right: 0.5rem;
}

/* primary */
.btn-primary {
  color: #fff;
  background-color: #b66dff;
  border-color: #b66dff;
}
.btn-primary:hover {
  color: #fff;
  background-color: #a347ff;
  border-color: #9d3aff;
}
.btn-primary:focus,
.btn-primary.focus {
  color: #fff;
  background-color: #a347ff;
  border-color: #9d3aff;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(193, 131, 255, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(193, 131, 255, 0.5);
}
.btn-primary.disabled,
.btn-primary:disabled {
  color: #fff;
  background-color: #b66dff;
  border-color: #b66dff;
}
.btn-primary:not(:disabled):not(.disabled):active,
.btn-primary:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #9d3aff;
  border-color: #962dff;
}
.btn-primary:not(:disabled):not(.disabled):active:focus,
.btn-primary:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(193, 131, 255, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(193, 131, 255, 0.5);
}

.btn-secondary {
  background-color: #c3bdbd;
  border-color: #c3bdbd;
}
.btn-secondary:hover {
  background-color: #b1a9a9;
  border-color: #aba2a2;
}
.btn-secondary:focus,
.btn-secondary.focus {
  background-color: #b1a9a9;
  border-color: #aba2a2;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(171, 166, 167, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(171, 166, 167, 0.5);
}
.btn-secondary.disabled,
.btn-secondary:disabled {
  background-color: #c3bdbd;
  border-color: #c3bdbd;
}
.btn-secondary:not(:disabled):not(.disabled):active,
.btn-secondary:not(:disabled):not(.disabled).active {
  background-color: #aba2a2;
  border-color: #a59c9c;
}
.btn-secondary:not(:disabled):not(.disabled):active:focus,
.btn-secondary:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(171, 166, 167, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(171, 166, 167, 0.5);
}

.btn-success {
  background-color: #1bcfb4;
  border-color: #1bcfb4;
}
.btn-success:hover {
  color: #fff;
  background-color: #17ad97;
  border-color: #15a28d;
}
.btn-success:focus,
.btn-success.focus {
  color: #fff;
  background-color: #17ad97;
  border-color: #15a28d;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(28, 182, 159, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(28, 182, 159, 0.5);
}
.btn-success.disabled,
.btn-success:disabled {
  background-color: #1bcfb4;
  border-color: #1bcfb4;
}
.btn-success:not(:disabled):not(.disabled):active,
.btn-success:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #15a28d;
  border-color: #149783;
}
.btn-success:not(:disabled):not(.disabled):active:focus,
.btn-success:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(28, 182, 159, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(28, 182, 159, 0.5);
}

.btn-info {
  color: #fff;
  background-color: #198ae3;
  border-color: #198ae3;
}
.btn-info:hover {
  color: #fff;
  background-color: #1575c1;
  border-color: #146eb5;
}
.btn-info:focus,
.btn-info.focus {
  color: #fff;
  background-color: #1575c1;
  border-color: #146eb5;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(60, 156, 231, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(60, 156, 231, 0.5);
}
.btn-info.disabled,
.btn-info:disabled {
  color: #fff;
  background-color: #198ae3;
  border-color: #198ae3;
}
.btn-info:not(:disabled):not(.disabled):active,
.btn-info:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #146eb5;
  border-color: #1367aa;
}
.btn-info:not(:disabled):not(.disabled):active:focus,
.btn-info:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(60, 156, 231, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(60, 156, 231, 0.5);
}

.btn-warning {
  background-color: #fed713;
  border-color: #fed713;
}
.btn-warning:hover {
  background-color: #eac301;
  border-color: #ddb901;
}
.btn-warning:focus,
.btn-warning.focus {
  background-color: #eac301;
  border-color: #ddb901;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(221, 188, 22, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(221, 188, 22, 0.5);
}
.btn-warning.disabled,
.btn-warning:disabled {
  background-color: #fed713;
  border-color: #fed713;
}
.btn-warning:not(:disabled):not(.disabled):active,
.btn-warning:not(:disabled):not(.disabled).active {
  background-color: #ddb901;
  border-color: #d0ae01;
}
.btn-warning:not(:disabled):not(.disabled):active:focus,
.btn-warning:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(221, 188, 22, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(221, 188, 22, 0.5);
}

.btn-danger {
  background-color: #fe7c96;
  border-color: #fe7c96;
}
.btn-danger:hover {
  color: #fff;
  background-color: #fe5678;
  border-color: #fe496d;
}
.btn-danger:focus,
.btn-danger.focus {
  color: #fff;
  background-color: #fe5678;
  border-color: #fe496d;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(221, 111, 134, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(221, 111, 134, 0.5);
}
.btn-danger.disabled,
.btn-danger:disabled {
  background-color: #fe7c96;
  border-color: #fe7c96;
}
.btn-danger:not(:disabled):not(.disabled):active,
.btn-danger:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #fe496d;
  border-color: #fe3d63;
}
.btn-danger:not(:disabled):not(.disabled):active:focus,
.btn-danger:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(221, 111, 134, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(221, 111, 134, 0.5);
}

.btn-light {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
}
.btn-light:hover {
  color: #212529;
  background-color: #e2e6ea;
  border-color: #dae0e5;
}
.btn-light:focus,
.btn-light.focus {
  color: #212529;
  background-color: #e2e6ea;
  border-color: #dae0e5;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, 0.5);
}
.btn-light.disabled,
.btn-light:disabled {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
}
.btn-light:not(:disabled):not(.disabled):active,
.btn-light:not(:disabled):not(.disabled).active {
  color: #212529;
  background-color: #dae0e5;
  border-color: #d3d9df;
}
.btn-light:not(:disabled):not(.disabled):active:focus,
.btn-light:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, 0.5);
}

.btn-dark {
  color: #fff;
  background-color: #3e4b5b;
  border-color: #3e4b5b;
}
.btn-dark:hover {
  color: #fff;
  background-color: #2f3844;
  border-color: #29323d;
}
.btn-dark:focus,
.btn-dark.focus {
  color: #fff;
  background-color: #2f3844;
  border-color: #29323d;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(91, 102, 116, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(91, 102, 116, 0.5);
}
.btn-dark.disabled,
.btn-dark:disabled {
  color: #fff;
  background-color: #3e4b5b;
  border-color: #3e4b5b;
}
.btn-dark:not(:disabled):not(.disabled):active,
.btn-dark:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #29323d;
  border-color: #242c35;
}
.btn-dark:not(:disabled):not(.disabled):active:focus,
.btn-dark:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(91, 102, 116, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(91, 102, 116, 0.5);
}

/* outline */
.btn-outline-primary {
  color: #b66dff;
  border-color: #b66dff;
}
.btn-outline-primary:hover {
  color: #fff;
  background-color: #b66dff;
  border-color: #b66dff;
}
.btn-outline-primary:focus,
.btn-outline-primary.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(182, 109, 255, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(182, 109, 255, 0.5);
}
.btn-outline-primary.disabled,
.btn-outline-primary:disabled {
  color: #b66dff;
  background-color: transparent;
}
.btn-outline-primary:not(:disabled):not(.disabled):active,
.btn-outline-primary:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #b66dff;
  border-color: #b66dff;
}
.btn-outline-primary:not(:disabled):not(.disabled):active:focus,
.btn-outline-primary:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(182, 109, 255, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(182, 109, 255, 0.5);
}

.btn-outline-secondary {
  color: #c3bdbd;
  border-color: #c3bdbd;
}
.btn-outline-secondary:hover {
  background-color: #c3bdbd;
  border-color: #c3bdbd;
}
.btn-outline-secondary:focus,
.btn-outline-secondary.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(195, 189, 189, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(195, 189, 189, 0.5);
}
.btn-outline-secondary.disabled,
.btn-outline-secondary:disabled {
  color: #c3bdbd;
  background-color: transparent;
}
.btn-outline-secondary:not(:disabled):not(.disabled):active,
.btn-outline-secondary:not(:disabled):not(.disabled).active {
  color: #212529;
  background-color: #c3bdbd;
  border-color: #c3bdbd;
}
.btn-outline-secondary:not(:disabled):not(.disabled):active:focus,
.btn-outline-secondary:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(195, 189, 189, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(195, 189, 189, 0.5);
}

.btn-outline-success {
  color: #1bcfb4;
  border-color: #1bcfb4;
}
.btn-outline-success:hover {
  background-color: #1bcfb4;
  border-color: #1bcfb4;
}
.btn-outline-success:focus,
.btn-outline-success.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(27, 207, 180, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(27, 207, 180, 0.5);
}
.btn-outline-success.disabled,
.btn-outline-success:disabled {
  color: #1bcfb4;
  background-color: transparent;
}
.btn-outline-success:not(:disabled):not(.disabled):active,
.btn-outline-success:not(:disabled):not(.disabled).active {
  background-color: #1bcfb4;
  border-color: #1bcfb4;
}
.btn-outline-success:not(:disabled):not(.disabled):active:focus,
.btn-outline-success:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(27, 207, 180, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(27, 207, 180, 0.5);
}

.btn-outline-info {
  color: #198ae3;
  border-color: #198ae3;
}
.btn-outline-info:hover {
  color: #fff;
  background-color: #198ae3;
  border-color: #198ae3;
}
.btn-outline-info:focus,
.btn-outline-info.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(25, 138, 227, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(25, 138, 227, 0.5);
}
.btn-outline-info.disabled,
.btn-outline-info:disabled {
  color: #198ae3;
  background-color: transparent;
}
.btn-outline-info:not(:disabled):not(.disabled):active,
.btn-outline-info:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #198ae3;
  border-color: #198ae3;
}
.btn-outline-info:not(:disabled):not(.disabled):active:focus,
.btn-outline-info:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(25, 138, 227, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(25, 138, 227, 0.5);
}

.btn-outline-warning {
  color: #fed713;
  border-color: #fed713;
}
.btn-outline-warning:hover {
  color: #fff;
  background-color: #fed713;
  border-color: #fed713;
}
.btn-outline-warning:focus,
.btn-outline-warning.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(254, 215, 19, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(254, 215, 19, 0.5);
}
.btn-outline-warning.disabled,
.btn-outline-warning:disabled {
  color: #fed713;
  background-color: transparent;
}
.btn-outline-warning:not(:disabled):not(.disabled):active,
.btn-outline-warning:not(:disabled):not(.disabled).active {
  background-color: #fed713;
  border-color: #fed713;
}
.btn-outline-warning:not(:disabled):not(.disabled):active:focus,
.btn-outline-warning:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(254, 215, 19, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(254, 215, 19, 0.5);
}

.btn-outline-danger {
  color: #fe7c96;
  border-color: #fe7c96;
}
.btn-outline-danger:hover {
  background-color: #fe7c96;
  border-color: #fe7c96;
}
.btn-outline-danger:focus,
.btn-outline-danger.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(254, 124, 150, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(254, 124, 150, 0.5);
}
.btn-outline-danger.disabled,
.btn-outline-danger:disabled {
  color: #fe7c96;
  background-color: transparent;
}
.btn-outline-danger:not(:disabled):not(.disabled):active,
.btn-outline-danger:not(:disabled):not(.disabled).active {
  background-color: #fe7c96;
  border-color: #fe7c96;
}
.btn-outline-danger:not(:disabled):not(.disabled):active:focus,
.btn-outline-danger:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(254, 124, 150, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(254, 124, 150, 0.5);
}

.btn-outline-light {
  color: #f8f9fa;
  border-color: #f8f9fa;
}
.btn-outline-light:hover {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
}
.btn-outline-light:focus,
.btn-outline-light.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.5);
}
.btn-outline-light.disabled,
.btn-outline-light:disabled {
  color: #f8f9fa;
  background-color: transparent;
}
.btn-outline-light:not(:disabled):not(.disabled):active,
.btn-outline-light:not(:disabled):not(.disabled).active {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
}
.btn-outline-light:not(:disabled):not(.disabled):active:focus,
.btn-outline-light:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.5);
}

.btn-outline-dark {
  color: #3e4b5b;
  border-color: #3e4b5b;
}
.btn-outline-dark:hover {
  color: #fff;
  background-color: #3e4b5b;
  border-color: #3e4b5b;
}
.btn-outline-dark:focus,
.btn-outline-dark.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(62, 75, 91, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(62, 75, 91, 0.5);
}
.btn-outline-dark.disabled,
.btn-outline-dark:disabled {
  color: #3e4b5b;
  background-color: transparent;
}
.btn-outline-dark:not(:disabled):not(.disabled):active,
.btn-outline-dark:not(:disabled):not(.disabled).active {
  color: #fff;
  background-color: #3e4b5b;
  border-color: #3e4b5b;
}
.btn-outline-dark:not(:disabled):not(.disabled):active:focus,
.btn-outline-dark:not(:disabled):not(.disabled).active:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(62, 75, 91, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(62, 75, 91, 0.5);
}

/* gradient buttons */
.btn-gradient-primary {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#da8cff),
    to(#9a55ff)
  );
  background: linear-gradient(to right, #da8cff, #9a55ff);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-primary:not([disabled]):not(.disabled):active,
.btn-gradient-primary:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#da8cff),
    to(#9a55ff)
  );
  background: linear-gradient(to right, #da8cff, #9a55ff);
}
.btn-gradient-primary:hover {
  opacity: 0.8;
}
.btn-gradient-primary:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-primary:not(.btn-gradient-light):hover,
.btn-gradient-primary:not(.btn-gradient-light):focus {
  color: #fff;
}

.btn-gradient-secondary {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#e7ebf0),
    to(#868e96)
  );
  background: linear-gradient(to right, #e7ebf0, #868e96);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-secondary:not([disabled]):not(.disabled):active,
.btn-gradient-secondary:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#e7ebf0),
    to(#868e96)
  );
  background: linear-gradient(to right, #e7ebf0, #868e96);
}
.btn-gradient-secondary:hover {
  opacity: 0.8;
}
.btn-gradient-secondary:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-secondary:not(.btn-gradient-light):hover,
.btn-gradient-secondary:not(.btn-gradient-light):focus,
.btn-gradient-secondary:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-success {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#84d9d2),
    to(#07cdae)
  );
  background: linear-gradient(to right, #84d9d2, #07cdae);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-success:not([disabled]):not(.disabled):active,
.btn-gradient-success:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#84d9d2),
    to(#07cdae)
  );
  background: linear-gradient(to right, #84d9d2, #07cdae);
}
.btn-gradient-success:hover {
  opacity: 0.8;
}
.btn-gradient-success:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-success:not(.btn-gradient-light):hover,
.btn-gradient-success:not(.btn-gradient-light):focus,
.btn-gradient-success:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-info {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#90caf9),
    color-stop(99%, #047edf)
  );
  background: linear-gradient(to right, #90caf9, #047edf 99%);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-info:not([disabled]):not(.disabled):active,
.btn-gradient-info:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#90caf9),
    color-stop(99%, #047edf)
  );
  background: linear-gradient(to right, #90caf9, #047edf 99%);
}
.btn-gradient-info:hover {
  opacity: 0.8;
}
.btn-gradient-info:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-info:not(.btn-gradient-light):hover,
.btn-gradient-info:not(.btn-gradient-light):focus,
.btn-gradient-info:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-warning {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#f6e384),
    to(#ffd500)
  );
  background: linear-gradient(to right, #f6e384, #ffd500);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-warning:not([disabled]):not(.disabled):active,
.btn-gradient-warning:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#f6e384),
    to(#ffd500)
  );
  background: linear-gradient(to right, #f6e384, #ffd500);
}
.btn-gradient-warning:hover {
  opacity: 0.8;
}
.btn-gradient-warning:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-warning:not(.btn-gradient-light):hover,
.btn-gradient-warning:not(.btn-gradient-light):focus,
.btn-gradient-warning:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-danger {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#ffbf96),
    to(#fe7096)
  );
  background: linear-gradient(to right, #ffbf96, #fe7096);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-danger:not([disabled]):not(.disabled):active,
.btn-gradient-danger:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#ffbf96),
    to(#fe7096)
  );
  background: linear-gradient(to right, #ffbf96, #fe7096);
}
.btn-gradient-danger:hover {
  opacity: 0.8;
}
.btn-gradient-danger:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-danger:not(.btn-gradient-light):hover,
.btn-gradient-danger:not(.btn-gradient-light):focus,
.btn-gradient-danger:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-light {
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#f4f4f4),
    to(#e4e4e9)
  );
  background: linear-gradient(to bottom, #f4f4f4, #e4e4e9);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-light:not([disabled]):not(.disabled):active,
.btn-gradient-light:not([disabled]):not(.disabled).active {
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#f4f4f4),
    to(#e4e4e9)
  );
  background: linear-gradient(to bottom, #f4f4f4, #e4e4e9);
}
.btn-gradient-light:hover {
  opacity: 0.8;
}
.btn-gradient-light:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-light:not(.btn-gradient-light):hover,
.btn-gradient-light:not(.btn-gradient-light):focus,
.btn-gradient-light:not(.btn-gradient-light):active {
  color: #fff;
}

.btn-gradient-dark {
  background: linear-gradient(89deg, #5e7188, #3e4b5b);
  border: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.btn-gradient-dark:not([disabled]):not(.disabled):active,
.btn-gradient-dark:not([disabled]):not(.disabled).active {
  background: linear-gradient(89deg, #5e7188, #3e4b5b);
}
.btn-gradient-dark:hover {
  opacity: 0.8;
}
.btn-gradient-dark:not(.btn-gradient-light) {
  color: #fff;
}
.btn-gradient-dark:not(.btn-gradient-light):hover,
.btn-gradient-dark:not(.btn-gradient-light):focus,
.btn-gradient-dark:not(.btn-gradient-light):active {
  color: #fff;
}

/*------------------------------------------*/
/*	    Form
/*------------------------------------------*/
.form-control {
  height: calc(1.5em + 0.75rem + 13px);
  padding: 13px 16px;
  font-size: inherit;
  border-color: #ebedf2;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.form-control:focus {
  box-shadow: none;
}
.form-control::-webkit-input-placeholder {
  /* Chrome/Opera/Safari */
  color: #ccc;
}
.form-control::-moz-placeholder {
  /* Firefox 19+ */
  color: #ccc;
}
.form-control:-ms-input-placeholder {
  /* IE 10+ */
  color: #ccc;
}
.form-control:-moz-placeholder {
  /* Firefox 18- */
  color: #ccc;
}
.input-group .form-control:first-child,
.input-group-addon:first-child,
.input-group-btn:first-child > .btn,
.input-group-btn:first-child > .btn-group > .btn,
.input-group-btn:first-child > .dropdown-toggle,
.input-group-btn:last-child > .btn-group:not(:last-child) > .btn,
.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle) {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.control-group select,
.control-group textarea,
.control-group input[type="text"],
.control-group input[type="password"],
.control-group input[type="datetime"],
.control-group input[type="datetime-local"],
.control-group input[type="date"],
.control-group input[type="month"],
.control-group input[type="time"],
.control-group input[type="week"],
.control-group input[type="number"],
.control-group input[type="email"],
.control-group input[type="url"],
.control-group input[type="search"],
.control-group input[type="tel"],
.control-group input[type="color"] {
  background: none repeat scroll 0 0 #fff;
}
.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:first-child > .btn-group:not(:first-child) > .btn,
.input-group-btn:first-child > .btn:not(:first-child),
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group > .btn,
.input-group-btn:last-child > .dropdown-toggle {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus {
  background-color: #fff !important;
  border-color: #80bdff !important;
  color: #696969 !important;
  box-shadow: 0 0 0 rgba(0, 0, 0, 0);
}
.checkbox label,
.radio label {
  padding-left: 0;
  padding-right: 20px;
}
.checkbox-inline,
.radio-inline {
  padding-left: 0;
}
.checkbox input[type="checkbox"],
.radio input[type="radio"],
.checkbox-inline input[type="checkbox"],
.radio-inline input[type="radio"] {
  opacity: 0;
}
input[type="checkbox"] + .lbl,
input[type="radio"] + .lbl {
  cursor: pointer;
  font-weight: normal;
  padding-left: 25px;
  padding-top: 5px;
  position: relative;
}
input[type="checkbox"]:disabled + .lbl,
input[type="radio"]:disabled + .lbl {
  color: #bbb;
  cursor: not-allowed;
}
input[type="checkbox"] + .lbl::before,
input[type="radio"] + .lbl::before,
input[type="radio"] + .lbl::after {
  position: absolute;
  display: block;
  left: 0;
  top: 3px;
}
input[type="checkbox"] + .lbl::before,
input[type="radio"] + .lbl::before {
  font-family: fontAwesome;
  content: "\a0";
  border: 1px solid #ccc;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  font-size: 12px;
  height: 16px;
  line-height: 14px;
  width: 16px;
  text-align: center;
}
input[type="checkbox"]:checked + .lbl::before,
input[type="radio"]:checked + .lbl::before {
  content: "\f00c";
  background-color: #fff;
  border-color: #adb8c0;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05),
    inset 0 -15px 10px -12px rgba(0, 0, 0, 0.05),
    inset 15px 10px -12px rgba(255, 255, 255, 0.1);
}
input[type="radio"] + .lbl::before,
input[type="radio"]:checked + .lbl::before {
  content: "";
  border-radius: 8px;
}
input[type="radio"]:checked + .lbl::after {
  background: #00b6e3;
  border-radius: 8px;
  content: "";
  height: 10px;
  left: 3px;
  top: 6px;
  width: 10px;
}
input[type="checkbox"]:disabled + .lbl::before,
input[type="radio"]:disabled + .lbl::before,
input[type="checkbox"][disabled] + .lbl::before,
input[type="radio"][disabled] + .lbl::before,
input[type="checkbox"].disabled + .lbl::before,
input[type="radio"].disabled + .lbl::before {
  background-color: #ddd !important;
  border-color: #ccc !important;
  box-shadow: none !important;
  color: #bbb;
}
input[type="checkbox"] + .lbl::before,
input[type="radio"] + .lbl::before {
  color: #00b6e3;
}
input[type="checkbox"]:hover + .lbl::before,
input[type="radio"]:hover + .lbl::before,
input[type="checkbox"] + .lbl:hover::before,
input[type="radio"] + .lbl:hover::before {
  border-color: #ffc107;
}
.checkbox,
.radio {
  margin-bottom: 15px;
}

/* input tag */
.vue-tags-input {
  max-width: 100% !important;
}
.ti-new-tag-input-wrapper {
  padding: 0 !important;
}

.ti-new-tag-input::-webkit-input-placeholder {
  /* Chrome/Opera/Safari */
  color: #aaa;
  font-size: 14px;
}
.ti-new-tag-input::-moz-placeholder {
  /* Firefox 19+ */
  color: #aaa;
  font-size: 14px;
}
.ti-new-tag-input:-ms-input-placeholder {
  /* IE 10+ */
  color: #aaa;
  font-size: 14px;
}
.ti-new-tag-input:-moz-placeholder {
  /* Firefox 18- */
  color: #aaa;
  font-size: 14px;
}
.ti-input {
  padding: 13px 16px !important;
  border-color: #ebedf2 !important;
}
.ti-tag {
  padding: 8px 16px !important;
  font-size: 14px !important;
  background-color: #da8cff !important;
}
.ti-icon-close {
  margin-left: 6px;
}

/* text editor */
.ql-toolbar.ql-snow {
  border-color: #ebedf2;
}
.ql-toolbar.ql-snow + .ql-container.ql-snow {
  border-color: #ebedf2;
}

/*------------------------------------------*/
/*	    Pagination
/*------------------------------------------*/
.page-link {
  border-color: #ebedf2 !important;
  color: #343a40;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
.page-link:hover {
  color: #fff;
  background-color: #c68bff;
  border-color: #c68bff !important;
}
.page-item.active .page-link {
  background: #b66dff;
  border-color: #b66dff !important;
}

.pagination li:first-child .page-link{
  border-radius: 25px 0 0 25px;
}
.pagination li:last-child .page-link{
  border-radius: 0 25px 25px 0;
}
</style>