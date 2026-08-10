<?php
public function bind()
{
    return $this->loadExtension('zentaobiz')->bind();
}

public function createUser($data)
{
    return $this->loadExtension('zentaobiz')->createUser($data);
}
