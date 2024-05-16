if("undefined"==typeof LiteVimeo){class e extends HTMLElement{constructor(){super()}connectedCallback(){this.videoId=encodeURIComponent(this.getAttribute("videoid"));let{width:t,height:i}=vimeoLiteGetThumbnailDimensions(this.getBoundingClientRect());const n=window.devicePixelRatio||1;t=Math.round(t*n),i=Math.round(i*n);let o=`https://lite-vimeo-embed.now.sh/thumb/${this.videoId}`;o+=`.${vimeoLiteCanUseWebP()?"webp":"jpg"}`,o+=`?mw=${t}&mh=${i}&q=${n>1?70:85}`,this.style.backgroundImage=`url("${o}")`;const d=document.createElement("button");d.type="button",d.classList.add("ltv-playbtn"),this.appendChild(d),this.addEventListener("pointerover",e._warmConnections,{once:!0}),this.addEventListener("click",()=>this._addIframe())}static _warmConnections(){e.preconnected||(vimeoLiteAddPrefetch("preconnect","https://player.vimeo.com"),vimeoLiteAddPrefetch("preconnect","https://i.vimeocdn.com"),vimeoLiteAddPrefetch("preconnect","https://f.vimeocdn.com"),vimeoLiteAddPrefetch("preconnect","https://fresnel.vimeocdn.com"),e.preconnected=!0)}_addIframe(){const e=`\n    <iframe width="640" height="360" frameborder="0"\n    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen\n    src="https://player.vimeo.com/video/${this.videoId}?autoplay=1"\n    ></iframe>`;this.insertAdjacentHTML("beforeend",e),this.classList.add("ltv-activated")}}void 0===customElements.get("lite-vimeo")&&customElements.define("lite-vimeo",e)}function vimeoLiteAddPrefetch(e,t,i){const n=document.createElement("link");n.rel=e,n.href=t,i&&(n.as=i),n.crossorigin=!0,document.head.appendChild(n)}function vimeoLiteCanUseWebP(){var e=document.createElement("canvas");return!(!e.getContext||!e.getContext("2d"))&&0===e.toDataURL("image/webp").indexOf("data:image/webp")}function vimeoLiteGetThumbnailDimensions({width:e,height:t}){let i=e=e||960,n=t=t||540;return i%320!=0&&(i=100*Math.ceil(e/100),n=Math.round(i/e*t)),{width:i,height:n}}