#!/bin/bash
aws --endpoint-url=http://localhost:4566 s3 mb s3://${LOCALSTACK_LOCAL_BUCKET}
aws --endpoint-url=http://localhost:4566 s3 sync /tmp/localstack-bucket/ s3://${LOCALSTACK_LOCAL_BUCKET}
