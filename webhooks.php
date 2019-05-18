
<?php
const functions = require("firebase-functions");
const request = require("request-promise");

const LINE_MESSAGING_API = "https://api.line.me/v2/bot/message";
const LINE_HEADER = {
  "Content-Type": "application/json",
  "Authorization": "Bearer <CHANNEL-ACCESS-TOKEN>"
};

exports.AdvanceMessage = functions.https.onRequest((req, res) => {
  return request({
    method: "POST",
    uri: `${LINE_MESSAGING_API}/push`,
    headers: LINE_HEADER,
    body: JSON.stringify({
      to: "<USER-ID>",
      messages: [
        {
          type: "template",
          altText: "This is a buttons template",
          template: {
            type: "buttons",
            thumbnailImageUrl: "https://www.nylon.com.sg/wp-content/uploads/2017/07/LINE-Friends.jpg",
            imageAspectRatio: "rectangle",
            imageSize: "cover",
            imageBackgroundColor: "#FFFFFF",
            title: "Menu",
            text: "Please select",
            defaultAction: {
              type: "uri",
              label: "View detail",
              uri: "https://developers.line.biz"
            },
            actions: [
              {
                type: "postback",
                label: "Buy",
                data: "action=buy&itemid=123"
              },
              {
                type: "uri",
                label: "View detail",
                uri: "https://line.me"
              }
            ]
          }
        }
      ]
    })
  }).then(() => {
      return res.status(200).send("Done");
  }).catch(error => {
      return Promise.reject(error);
  });
});
?>