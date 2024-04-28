// Items collection
var items = [
    {
      type: "text",
      title: "Fur",
      description: "The fur of clouded leopards is...",
      position: {
          left: 100,
          top: 50
      }
    },
    {
      type: "picture",
      path: "/path/to/picture.png",
      caption: "A baby clouded leopard",
      position: {
        left: 200,
        top: 300
      }
    },
    {
      type: "audio",
      path: "/path/to/sound.mp3",
      caption: "A clouded leopard growl",
      position: {
        left: 300,
        top: 500
      }
    },
    {
      type: "video",
      path: "/path/to/video.mp4",
      caption: "A clouded leopard walking",
      poster: "/path/to/poster.png",
      position: {
        left: 400,
        top: 550
      }
    },
    {
      type: "provider",
      providerName: "youtube",
      parameters: {
        videoId: "iPRiQ6SBntQ"
      },
      position: {
        left: 600,
        top: 550
      },
      sticky: true
    }
  ];
  
  // Plugin activation
  $(document).ready(function() {
    $("#my-interactive-image").interactiveImage(items);
  });