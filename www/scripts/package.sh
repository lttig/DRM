#!/bin/bash
source_file_id=$1
destination_dir=$2
hex_key_id=$3
hex_key=$4
/usr/local/Bento4/bin/mp4fragment temp/$source_file_id.mp4 temp/$source_file_id\-video-fragmented.mp4
/usr/local/Bento4/bin/mp4encrypt temp/$source_file_id.mp4 --method MPEG-CENC --key 1:$hex_key:random --property 1:KID:$hex_key_id --key 2:$hex_key:random --property 2:KID:$hex_key_id --global-option mpeg-cenc.eme-pssh:true temp/$source_file_id-video-fragmented.mp4 temp/$source_file_id-video-encrypted.mp
/usr/local/Bento4/bin/mp4dash --use-segment-timeline -o encrypted_videos/$destination_dir temp/$source_file_id\-video-fragmented.mp4
