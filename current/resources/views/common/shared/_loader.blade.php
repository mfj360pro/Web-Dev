<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-cube"><div></div><div></div><div></div><div></div></div><style type="text/css">@keyframes lds-cube {
    0% {
      -webkit-transform: scale(1.44);
      transform: scale(1.44);
    }
    100% {
      -webkit-transform: scale(1);
      transform: scale(1);
    }
  }
  @-webkit-keyframes lds-cube {
    0% {
      -webkit-transform: scale(1.44);
      transform: scale(1.44);
    }
    100% {
      -webkit-transform: scale(1);
      transform: scale(1);
    }
  }
  .lds-cube {
    position: relative;
  }
  .lds-cube div {
    position: absolute;
    width: 48px;
    height: 48px;
    top: 26px;
    left: 26px;
    background: #ff585f;
    -webkit-animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    -webkit-animation-delay: -0.3s;
    animation-delay: -0.3s;
  }
  .lds-cube div:nth-child(2) {
    top: 26px;
    left: 126px;
    background: #f8f871;
    -webkit-animation-delay: -0.2s;
    animation-delay: -0.2s;
  }
  .lds-cube div:nth-child(3) {
    top: 126px;
    left: 126px;
    background: #07c3b8;
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
  }
  .lds-cube div:nth-child(4) {
    top: 126px;
    left: 26px;
    background: #53ff8c;
    -webkit-animation-delay: -0.1s;
    animation-delay: -0.1s;
  }
  .lds-cube {
    width: 200px !important;
    height: 200px !important;
    -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
    transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  }
  </style></div>