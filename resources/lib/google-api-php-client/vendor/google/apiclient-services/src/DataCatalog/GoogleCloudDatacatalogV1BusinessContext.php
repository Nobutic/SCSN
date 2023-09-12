<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\DataCatalog;

class GoogleCloudDatacatalogV1BusinessContext extends \Google\Model
{
  protected $contactsType = GoogleCloudDatacatalogV1Contacts::class;
  protected $contactsDataType = '';
  public $contacts;
  protected $entryOverviewType = GoogleCloudDatacatalogV1EntryOverview::class;
  protected $entryOverviewDataType = '';
  public $entryOverview;

  /**
   * @param GoogleCloudDatacatalogV1Contacts
   */
  public function setContacts(GoogleCloudDatacatalogV1Contacts $contacts)
  {
    $this->contacts = $contacts;
  }
  /**
   * @return GoogleCloudDatacatalogV1Contacts
   */
  public function getContacts()
  {
    return $this->contacts;
  }
  /**
   * @param GoogleCloudDatacatalogV1EntryOverview
   */
  public function setEntryOverview(GoogleCloudDatacatalogV1EntryOverview $entryOverview)
  {
    $this->entryOverview = $entryOverview;
  }
  /**
   * @return GoogleCloudDatacatalogV1EntryOverview
   */
  public function getEntryOverview()
  {
    return $this->entryOverview;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDatacatalogV1BusinessContext::class, 'Google_Service_DataCatalog_GoogleCloudDatacatalogV1BusinessContext');
